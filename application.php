#!/usr/bin/env php
<?php

namespace Dcorr\MergeDniFromCsv;

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new Helloworldcommand());
$application->add(new MergerCommand());
$application->run();