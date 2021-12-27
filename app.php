<?php
use App\Console\Console;
use App\Console\Input;
use App\Console\SimpleOutput;
use App\Console\RegisterCommand;

require_once './vendor/autoload.php';

$commands = new RegisterCommand([\App\Examples\Test::class, \App\Examples\SecondTest::class]);
$input = new Input();
$output = new SimpleOutput();

$console = new Console($commands, $input, $output);
$console->run();