<?php
namespace Modgit\Command;

use Modgit\Command;

class Init implements Command
{
    const MODGIT_DIRNAME = '.modgit';

    public function run()
    {
        echo "Creating directory {$this->getDirectoryName()}...";

        if (file_exists($this->getDirectoryName())) {
            throw new \RuntimeException('Path ' . $this->getDirectoryName() . ' already exists.');
        }

        if (!@mkdir($this->getDirectoryName())) {
            throw new \RuntimeException('Could not create ' . $this->getDirectoryName() . ' directory.');
        }

        echo " ok.\n";
    }

    public function getDirectoryName()
    {
        return self::MODGIT_DIRNAME;
    }
}
