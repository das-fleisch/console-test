<?php

namespace App\Console;

abstract class Output
{

    public function write($messages, $newline = false)
    {
        if (!is_iterable($messages)) {
            $messages = [$messages];
        }

        foreach ($messages as $message) {
            $this->doWrite($message ?? '', $newline);
        }

    }

    abstract protected function doWrite($message, $newline);

}