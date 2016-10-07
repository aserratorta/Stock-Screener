<?php

namespace AppBundle\Command;

use AppBundle\Entity\Screener;
use AppBundle\Entity\Sector;
use AppBundle\Entity\Stock;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportScreenerCommand extends AbstractBaseCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import:screener')
            ->setDescription('Import screeners from csv file')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'path to file'
            )
            ->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will persist changes in database'
            );
    }

    //TODO drop the entire screener data

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to import screener command</info>');

        if ($input->getOption('force')) {
            $output->writeln(
                '<comment>--force option enabled (this option persists changes in database)</comment>'
            );
        }

        // Validate arguments
        $filesystem        = $this->getContainer()->get('filesystem');
        $filename          = $input->getArgument('filename');
        $fr                = fopen($filename, 'r');

        if (!$filesystem->exists($filename)) {
            throw new \InvalidArgumentException('The file '.$filename.' does not exists');
        }

        if ($fr == false) {
            throw new \InvalidArgumentException('The file '.$filename.' exist but can not be readed');
        }

        $output->writeln('loading data, please wait...');

        // Command Vars
        $index           = 0;
        $indexStart      = 2;
        $this->em        = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $itemsFound      = 0;

        ini_set('auto_detect_line_endings', true);

        $this->forceOptionIsEnabled = $input->getOption('force');

        while (($data = $this->readCSVLine($fr)) !== false) {
            if ($indexStart > ++$index) {
                // Is not valid indexStart?
                continue;
            }

            $sector_ticker = (string)$this->loadColumnData(0, $data);
            $stock_ticker = (string)$this->loadColumnData(0, $data);
            $value  = (string)$this->loadColumnData(1, $data);
            $title = (string)$this->loadColumnData(2, $data);

            $sector_ticker = $this->em->getRepository('AppBundle:Sector')->findOneBy(array('ticker'=> $sector_ticker ));
            $stock_ticker = $this->em->getRepository('AppBundle:Stock')->findOneBy(array('ticker'=> $stock_ticker));

            if ($sector_ticker && $stock_ticker) {

                $screener = $this->em->getRepository('AppBundle:Screener')->findOneBy(array(
                    'sector_ticker' => $sector_ticker,
                    'stock_ticker'=> $stock_ticker,
                    )
                );

                //TODO si no existeix -> sector nou

                if (!$screener) {

                    $screener = new Screener();
                }

                $screener
                    ->setSector($sector_ticker)
                    ->setStock($stock_ticker)
                    ->setValue($value)
                    ->setTitle($title);
            }
                $this->persistObject($stock_ticker);
                $itemsFound = $itemsFound + 1;
                $output->writeln($stock_ticker . ' ' . $value . ' ' . $title);
        }
        $output->writeln($itemsFound);
    }
}
