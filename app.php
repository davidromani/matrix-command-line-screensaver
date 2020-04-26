#!/usr/bin/env php

<?php

require __DIR__.'/vendor/autoload.php';

use App\Command\MatrixCommand;
use App\Command\TestCommand;
use Symfony\Component\Console\Application;

$testCommand = new TestCommand();
$matrixCommand = new MatrixCommand();

$application = new Application();
$application->add($testCommand);
$application->add($matrixCommand);
$application->setDefaultCommand($testCommand->getName());

$application->run();
