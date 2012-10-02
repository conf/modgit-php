<?php

use Modgit\Command\Init;

class InitTest extends \PHPUnit_Framework_TestCase
{
    public function testDirectoryModgitShouldExistAfterRunningInitCommand()
    {
        $command = new Init();
        DirectoryHelper::removeRecursively($command->getDirectoryName());

        $command->run();

        $this->assertFileExists($command->getDirectoryName(), 'Directory ' . $command->getDirectoryName() . ' should exist');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testInitCommandShouldThrowExceptionWhenModgitPathAlreadyExists()
    {
        $command = new Init();
        if (!file_exists($command->getDirectoryName())) {
            mkdir ($command->getDirectoryName());
        }

        $command->run();

        $this->fail('Init should throw RuntimeException when ' . $command->getDirectoryName() . ' path already exists.');
    }

    public function testInitCommandShouldThrowExceptionWhenMkdirReturnsFalse()
    {
        if ($this->isWindows()) {
            $this->markTestSkipped('This test is not supported on Windows.');
        }

        $oldCurrentDirectory = getcwd();
        $tempDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid();
        mkdir($tempDir);
        chdir($tempDir);
        chmod($tempDir, 0500);
        try {
            $command = new Init();
            $command->run();
            $this->fail('Init should throw RuntimeException when ' . $command->getDirectoryName() . ' path already exists.');
        } catch (RuntimeException $e) {
            chdir($oldCurrentDirectory);
            DirectoryHelper::removeRecursively($tempDir);
        }
    }

    private function isWindows()
    {
        return '\\' === DIRECTORY_SEPARATOR;
    }

}
