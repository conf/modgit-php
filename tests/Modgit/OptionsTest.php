<?php

use Modgit\Options;

class OptionsTest extends \PHPUnit_Framework_TestCase
{

    public function testGetCommandReturnsEmptyArrayOnEmptyArguments()
    {
        $options = new Options(array());
        $this->assertSame(array(), $options->getCommand());
    }

    public function testGetCommandReturnsFilledArrayOnCorrectArguments()
    {
        $options = new Options(array('script.php', 'clone', 'github', 'http://github.com'));
        $expected = array(
            'name' => 'clone',
            'arguments' => array(
                'github',
                'http://github.com'
            )
        );

        $this->assertEquals($expected, $options->getCommand());
    }

    public function testGetCommandReturnsEmptyArrayOnUnknownCommand()
    {
        $options = new Options(array('script.php', 'unknown', 'github', 'http://github.com'));
        $this->assertEquals(array(), $options->getCommand());
    }
}
