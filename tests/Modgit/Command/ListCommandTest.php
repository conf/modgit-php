<?php

use Modgit\Command\ListCommand,
    Modgit\Command\Init;

class ListCommandTest extends \PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        $this->removeModgitDirectory();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testListCommandShouldThrowExceptionWhenNoModgitDirIsFound()
    {
        $this->removeModgitDirectory();

        $list = new ListCommand();
        $list->run();
    }

    public function testListCommandReturnsEmptyArrayOnFreshInitializedProject()
    {
        $this->runInit();

        $list = new ListCommand();
        $this->assertEquals(array(), $list->run());
    }

    public function testListCommandReturnsDirectoriesListFromModgitDirectory()
    {
        $this->runInit();

        $modgitDir = $this->getModgitDirectory();
        mkdir($modgitDir . '/one');
        mkdir($modgitDir . '/two');

        $list = new ListCommand();
        $this->assertEquals(array('one', 'two'), $list->run());
    }

    private function getModgitDirectory()
    {
        return '.modgit';
    }

    private function removeModgitDirectory()
    {
        DirectoryHelper::removeRecursively($this->getModgitDirectory());
    }

    private function runInit()
    {
        $init = new Init();
        $init->run();
    }
}
