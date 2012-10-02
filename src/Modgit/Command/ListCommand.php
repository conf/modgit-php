<?php
namespace Modgit\Command;

use Modgit\Command;
use Modgit\Command\Init;

class ListCommand implements Command
{
    public function run()
    {
        if (!is_dir($this->getModgitDirectory())) {
            throw new \RuntimeException("Module Git directory not found.\nRun 'modgit init' in the root of your project.");
        }

        $directories = $this->readDirectoriesList();
        if ($directories) {
            echo implode("\n", $directories) . "\n";
        }

        return $directories;
    }

    private function readDirectoriesList()
    {
        $pattern = $this->getModgitDirectory() . '/*';
        return array_map('basename', glob($pattern, GLOB_ONLYDIR));
    }

    private function getModgitDirectory()
    {
        $init = new Init();
        return $init->getDirectoryName();
    }
}
