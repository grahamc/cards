<?php

/**
 * Test class for Filter_Ascending_Exception.
 * Generated by PHPUnit on 2010-05-06 at 11:06:51.
 */
class Filter_Ascending_ExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Filter_Ascending_Exception
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Filter_Ascending_Exception;
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
