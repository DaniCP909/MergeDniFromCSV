#!/usr/bin/env php
<?php

namespace Dcorr\MergeDniFromCsv;

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new Helloworldcommand());
$application->add(new MergerCommand());
/*
$test_csv_file = new CsvReader('fichero.csv');
$test_csv_file->printRCsv();

echo "\n";

$wcsv = new CsvWriter('solucion.csv');
$wcsv->setNewRecord(array('Dani','Corredor', 'Padrino'));
$wcsv->setNewRecord(array('Javi', 'Nogues', 'Alguacil'));
$wcsv->setNewRecord(array('Fernando', 'Alonso', 'Díaz'));
$wcsv->setNewRecord(array('campo4'));
$wcsv->writeCsv();

$wcsv->printWCsv() . "\n";
*/
$application->run();