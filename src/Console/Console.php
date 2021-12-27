<?php

namespace App\Console;

use \Exception;
use \ReflectionException;

class Console
{
    private RegisterCommand $register;
    private Input $input;
    private Output $output;

    public function __construct(RegisterCommand $register, Input $input, Output $output)
    {
        $this->register = $register;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function run()
    {
        $commandName = $this->input->getCommandName();
        if(!$this->input->isHelp() && $commandName) {
            $command = $this->register->getCommand($this->input->getCommandName());
            $command->execute($this->input, $this->output);
        } else if ($commandName){
            $this->output->write(print_r($this->register->listCommand($this->input->getCommandName()), true), true);
        } else {
            $this->output->write(print_r($this->register->listCommand(), true), true);
        }
    }
}