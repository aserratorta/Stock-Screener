<?php

namespace AppBundle\Command;

use AppBundle\Entity\Sector;
use AppBundle\Entity\Stock;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportStockCommand extends AbstractBaseCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import:stock')
            ->setDescription('Import stocks from csv file')
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to import stock command</info>');

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
        $indexStart      = 1;
        $this->em        = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $itemsFound      = 0;

        ini_set('auto_detect_line_endings', true);

        $this->forceOptionIsEnabled = $input->getOption('force');

        while (($data = $this->readCSVLine($fr)) !== false) {
            if ($indexStart > ++$index) {
                // Is not valid indexStart?
                continue;
            }

            $stock_ticker = (string)$this->loadColumnData(1, $data);
            $stock_title  = (string)$this->loadColumnData(2, $data);
            $sector_ticker = (string)$this->loadColumnData(3, $data);
            $market_cap = (float)$this->loadColumnData(5, $data);
            $exchange = (string)$this->loadColumnData(6, $data);

            $sector = $this->em->getRepository('AppBundle:Sector')->findOneBy(array('ticker'=> $sector_ticker ));

            if ($sector) {

                //repositori de stocks i buscar un ticker = stock_ticker
                $stock_ticker_exist = $this->em->getRepository('AppBundle:Stock')->findOneBy(array('ticker'=> $stock_ticker));

                //si no existeix -> stock nou
                if (!$stock_ticker_exist) {

                    $stock_ticker_exist = new Stock();
                }

                $stock_ticker_exist->setSector($sector);
                $stock_ticker_exist->setTicker($stock_ticker);
                $stock_ticker_exist->setTitle($stock_title);
                $stock_ticker_exist->setCapAmount($market_cap);
                $stock_ticker_exist->setExchange($exchange);

                $this->persistObject($stock_ticker_exist);
                $itemsFound = $itemsFound + 1;
                $output->writeln($stock_ticker.' '.$stock_title.' '.$sector_ticker.' '.$market_cap.' '.$exchange );
            }
        }
        $output->writeln($itemsFound);
    }
}
