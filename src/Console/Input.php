<?php

namespace App\Console;

class Input
{
    private ?string $commandName = null;

    private string $patternArgs = '/^\{(.+?)\}$/';

    private array $args = [];

    private string $patternOptions = '/^\[(.+)=\{?(.+?)\}?\]$/';

    private array $options = [];

    private array $tokens;

    public function __construct()
    {
        $argv = $_SERVER['argv'] ?? [];

        // strip the application name ;-)
        array_shift($argv);

        $this->tokens = $argv;

        if(!$this->isHelp()) {
            $this->commandName = array_shift($this->tokens);
        }

        if(!$this->isHelp()) {
            $this->parse();
        }
    }

    private function parse() : void
    {
        foreach ($this->tokens as $token) {
            if(preg_match($this->patternArgs, $token, $matches)) {
                [, $value] = $matches;
                $this->args = array_merge($this->args, explode(',', $value));
            }
            if(preg_match($this->patternOptions, $token, $matches)) {
                [, $name, $value] = $matches;
                if(!isset($this->options[$name])) {
                    $this->options[$name] = [];
                }
                $this->options[$name] = array_merge($this->options[$name], explode(',', $value));
            }
        }

    }

    public function isHelp() : bool
    {
        return count($this->tokens) == 1 && $this->tokens[0] == '{help}';
    }

    public function getCommandName() : ?string
    {
        return $this->commandName;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function getOptions(): array
    {
        return $this->options;
    }


}