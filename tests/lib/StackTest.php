<?php

require_once dirname(__FILE__).'/../../lib/Stack.php';

/**
 * Test class for Stack.
 * Generated by PHPUnit on 2010-05-06 at 08:46:06.
 */
class StackTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Stack
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Stack(array(new Card('C', 1)));
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * Make sure we can add a filter
	 */
	public function testAddFilter() {
		$filter = new Filter_Fail();
		$this->object->addFilter($filter);
		$this->assertEquals($this->object->getFilters(), array($filter));
	}

	/**
	 * @expectedException Filter_Fail_Exception
	 */
	public function testFilters() {
		$stack = new Stack(array(new Card('C', 2)));
		$this->object->addFilter(new Filter_Fail());
		$this->object->add($stack);
	}



	/**
	 * Make sure we can disable filters
	 */
	public function testDisableFilters() {
		$stack = new Stack(array(new Card('C', 2)));
		$this->object->addFilter(new Filter_Fail());
		$this->object->disableFilters();
		$this->assertTrue($this->object->add($stack));
	}



	/**
	 * @expectedException Filter_Fail_Exception
	 * Make sure we can enable filters again after disabling them
	 */
	public function testEnableFilters() {
		$stack = new Stack(array(new Card('C', 2)));
		$this->object->addFilter(new Filter_Fail());
		$this->object->disableFilters();
		$this->object->enableFilters();
		$this->object->add($stack);
	}

	/**
	 * Make sure we can actually add stacks
	 */
	public function testAdd() {
		$stack = new Stack(array(new Card('C', 2)));
		$this->object->add($stack);
		$this->assertEquals($this->object->getCards(), array(new Card('C', 1), new Card('C', 2)));
	}

	/**
	 * @todo Implement testPop().
	 */
	public function testPop() {
		$stack = $this->object->pop(1);
		$this->assertEquals($stack, new Stack(array(new Card('C', 1))));
		$this->assertEquals($this->object, new Stack(array()));
	}

	/**
	 * @todo Implement testGetCards().
	 */
	public function testGetCards() {
		$this->assertEquals($this->object->getCards(), array(new Card('C', 1)));
	}
}
?>
