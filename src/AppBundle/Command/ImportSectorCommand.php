<?php

namespace AppBundle\Command;

use AppBundle\Entity\Sector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSectorCommand extends AbstractBaseCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import:sector')
            ->setDescription('Import sector from csv file')
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
        $output->writeln('<info>Welcome to import sector command</info>');

        if ($input->getOption('force') == true) {
            $output->writeln(
                '<comment>--force option enabled (this option persists changes in database)</comment>'
            );
        }

        // Validate arguments
        $importSectionOnly = false;
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
        $dtStart         = new \DateTime();
        $index           = 0;
        $indexStart      = 0;
        $this->em        = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $itemsFound      = 0;

        ini_set('auto_detect_line_endings', true);

        $this->forceOptionIsEnabled = $input->getOption('force');

        while (($data = $this->readCSVLine($fr)) !== false) {
            if ($indexStart > ++$index) {
                // Is not valid indexStart?
                continue;
            }

            $supers_ticker = (string)$this->loadColumnData(0, $data);
            $sector_ticker = (string)$this->loadColumnData(2, $data);
            $sector_title  = (string)$this->loadColumnData(3, $data);

            $supersector = $this->em->getRepository('AppBundle:SuperSector')->findOneBy(array('ticker'=> $supers_ticker ));

            if ($supersector) {

                //TODO repositori de sectors i buscar un ticker = sector_ticker
                $sector_ticker_exist = $this->em->getRepository('AppBundle:Sector')->findOneBy(array('ticker'=> $sector_ticker));

                //TODO si no existeix -> sector nou
                if (!$sector_ticker_exist) {

                    $sector_ticker_exist = new Sector();
                }

                $sector_ticker_exist
                    ->setSuperSector($supersector)
                    ->setTicker($sector_ticker)
                    ->setTitle($sector_title);

                $this->persistObject($sector_ticker_exist);
                $itemsFound = $itemsFound + 1;
            }
//            $output->writeln($sector_title);
        }
        $output->writeln($itemsFound);
    }
}
