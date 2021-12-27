<?php

namespace App\Console;

abstract class Command
{
    protected static string $name;

    protected static string $desc = '';

    public function getName(): string
    {
        return static::$name;
    }

    public function getDesc(): string
    {
        return static::$desc;
    }

    public function execute(Input $input, Output $output)
    {


    }


}