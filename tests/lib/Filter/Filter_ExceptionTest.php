<?php

require_once dirname(__FILE__).'/../../../lib/Filter/Exception.php';

/**
 * Test class for Filter_Exception.
 * Generated by PHPUnit on 2010-05-06 at 08:46:08.
 */
class Filter_ExceptionTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Filter_Exception
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Filter_Exception;
	}


	public function testType() {
		$this->assertTrue($this->object instanceof Exception);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}
}
?>
