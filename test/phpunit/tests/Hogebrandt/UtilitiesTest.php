<?php
namespace Test;

class UtilitiesTest extends TestCase
{

    /**
     * Tests Utilities static methods
     *
     * @return void
     */
    public function testGetsCorrectKey()
    {
        $array = array('a', 'b', 'c');

        $this->assertEquals(0, \Utilities::getIdInArray($array, 'a'));
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testsUnexpectedValue()
    {
        $array = array('a', 'b', 'c');

        \Utilities::getIdInArray($array, 'd');
    }
}
