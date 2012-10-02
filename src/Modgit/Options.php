<?php

namespace Modgit;

class Options
{
    private $arguments;

    private $parts;

    private $commands = array('clone', 'remove', 'init', 'list', 'update', 'update-all');

    function __construct($arguments)
    {
        $this->arguments = $arguments;
    }

    function getCommand()
    {
        return $this->getPart('command');
    }

    private function getPart($name)
    {
        $this->parse();
        return isset($this->parts[$name]) ? $this->parts[$name] : array();
    }

    private function parse()
    {
        if (empty($this->arguments)) {
            return;
        }

        $this->shiftArgument(); // shift off script name

        try {
            $this->parseCommand();
        } catch (\InvalidArgumentException $e) {
            ; // intentionally left empty
        }
    }

    private function parseCommand()
    {
        $command = $this->shiftArgument();

        if (!in_array($command, $this->commands)) {
            throw new \InvalidArgumentException("Unknown command $command");
        }

        $this->parts['command'] = array(
            'name' => $command,
            'arguments' => $this->arguments
        );
    }

    private function shiftArgument()
    {
        return array_shift($this->arguments);
    }
}
