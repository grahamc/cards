<?php

/**
 * Test class for Card_Exception_Number.
 * Generated by PHPUnit on 2010-05-06 at 11:06:50.
 */
class Card_Exception_NumberTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Card_Exception_Number
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Card_Exception_Number;
    }


	public function testType() {
		$this->assertTrue($this->object instanceof Exception);
	}

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
?>
