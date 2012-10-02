#!/usr/bin/env php
<?php
namespace Modgit;

require_once __DIR__ . '/Autoloader.php';

Autoloader::register();

$options = new Options($_SERVER['argv']);

$commandLine = $options->getCommand() ? $options->getCommand() : 'help';

switch($commandLine['name']) {
    case 'init':
        $command = new Command\Init();
        break;
    case 'list':
        $command = new Command\ListCommand();
        break;
    default:
        var_dump($options->getCommand());
        echo "Unknown command!";
        exit(1);
}

$command->run();
