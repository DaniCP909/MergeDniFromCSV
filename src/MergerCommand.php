<?php

namespace Dcorr\MergeDniFromCsv;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputStream;

use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Statement;
use RuntimeException;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;



class MergerCommand extends Command
{
    protected static $defaultName = 'dnimerge';

    protected function configure()
    {
        $this->setDescription('Command to read and write in CSV files');
        $this
            ->addArgument('column', InputArgument::REQUIRED, 'Column of DNI or NIE')
            ->addArgument('sourcePath', InputArgument::REQUIRED, 'Source file Path')
        ;
        $this
            ->addOption('destinationPath', null, InputOption::VALUE_REQUIRED, 'Destination file Path', './src/CSVs/auto-gen.csv')
            ->addOption('hasHeader', null, InputOption::VALUE_NONE, 'given CSV has header')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $srcPath = $input->getArgument('sourcePath');
        $columnNumber = $input->getArgument('column');
        
        $dniMerger = new DniMerger();

        $sourceFile = Reader::createFromPath($srcPath, 'r');
        $destinationFile = Writer::createFromPath($input->getOption('destinationPath'), 'w');
        if($input->getOption('hasHeader') != null) {
            $sourceFile->setHeaderOffset(0);
            $destinationFile->insertOne($sourceFile->getHeader());
        }
 
        $allRecords = $sourceFile->getRecords();



        foreach ($allRecords as $key=>$record) {
            if(!isset($record[$columnNumber])) {
                throw new RuntimeException('Invalid field index at line: ' . $key);
            }
            
            $selectedColumn = $record[$columnNumber];
            if($dniMerger->isDNIColumn($selectedColumn)) {
                $newData = $record[$columnNumber] . $dniMerger->computeChecksumDNI($selectedColumn);
                $record[] = $newData;
            }
            else if($dniMerger->isNIEColumn($selectedColumn)) {
                $newData = $selectedColumn. $dniMerger->computeChecksumNIE($selectedColumn);
                $record[] = $newData;
            }
            
            $destinationFile->insertOne($record);
        }

        return Command::SUCCESS;
    }

}