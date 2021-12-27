<?php

namespace App\Console;

use \Exception;
use \ReflectionClass;
use \ReflectionException;

class RegisterCommand
{
    private array $commands = [];

    /**
     * RegisterCommand constructor.
     * @param array $commands
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct(array $commands)
    {
        foreach ($commands as $className) {
            $reflectionClass = new ReflectionClass($className);
            $commandName = $reflectionClass->getStaticPropertyValue('name', '');
            if($reflectionClass->isInstantiable()) {
                if(!empty($commandName) && !isset($this->commands[$commandName])) {
                    $this->commands[$commandName] = $className;
                } else {
                    throw new Exception('Command '.($commandName ? $commandName.' already exists' : 'has no name in '.$className));
                }
            }
        }
    }

    /**
     * @param string $commandName
     * @return Command|null
     * @throws Exception
     */
    public function getCommand(string $commandName) : ?Command
    {
        $result = null;
        if(isset($this->commands[$commandName])) {
            $result = new $this->commands[$commandName];
            if(!($result instanceof Command)) {
                throw new Exception($this->commands[$commandName].' must be instance of Command');
            }
        }

        return $result;
    }

    /**
     * @param string|null $commandName
     * @return array
     * @throws ReflectionException
     */
    public function listCommand(?string $commandName = null) : array
    {
        $result = [];
        if(!empty($commandName)) {
            if(isset($this->commands[$commandName])) {
                $result[$commandName] = $this->getCommandDescription($this->commands[$commandName]);
            }
        } else {
            foreach ($this->commands as $name => $className) {
                $result[$name] = $this->getCommandDescription($className);
            }
        }

        return $result;
    }

    /**
     * @param string $className
     * @return string
     * @throws ReflectionException
     */
    private function getCommandDescription(string $className) : string
    {
        $reflectionClass = new ReflectionClass($className);
        return $reflectionClass->getStaticPropertyValue('desc', '');
    }

}