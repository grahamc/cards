<?php
require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__).'/../../../lib/Filter/Pass.php';

/**
 * Test class for Filter_Pass.
 * Generated by PHPUnit on 2010-05-07 at 09:13:25.
 */
class Filter_PassTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Filter_Pass
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Filter_Pass;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * @todo Implement testAttempt().
	 */
	public function testAttempt() {
		$this->assertTrue($this->object->attempt(new Card('C', 1), new Card('C', 1)));
	}
}
?>