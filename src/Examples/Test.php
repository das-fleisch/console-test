<?php

namespace App\Examples;

use App\Console\Command;
use App\Console\Input;
use App\Console\Output;

class Test extends Command
{
    protected static string $name = 'test';

    protected static string $desc = 'Тестовая команда';

    public function execute(Input $input, Output $output)
    {
        $output->write('Имя команды: '.self::$name, true);
        $output->write('Описание команды: '.self::$desc, true);
        $output->write('Полученые аргументы: '.print_r($input->getArgs(), true), true);
        $output->write('Полученые параметры: '.print_r($input->getOptions(), true), true);

    }
}