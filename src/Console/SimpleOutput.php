<?php

namespace App\Console;

use const PHP_EOL;

class SimpleOutput extends  Output
{
    protected function doWrite($message, $newline)
    {
        echo $message.($newline ? PHP_EOL : "");
    }
}