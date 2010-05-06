<?php
require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__).'/../../lib/Card.php';
require_once dirname(__FILE__).'/../../lib/Card/Exception.php';
require_once dirname(__FILE__).'/../../lib/Card/Exception/Suit.php';
require_once dirname(__FILE__).'/../../lib/Card/Exception/Number.php';

/**
 * Test class for Card.
 * Generated by PHPUnit on 2010-05-06 at 08:46:06.
 */
class CardTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Card
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Card('C', 12);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * @expectedException Card_Exception
	 */
	public function testInvalidSuit() {
		$card = new Card('sdf', 12);
	}

	/**
	 * @expectedException Card_Exception
	 */
	public function testInvalidNumber() {
		$card = new Card('C', 42); // hike hike hike
	}

	/**
	 * @todo Implement testGetNumber().
	 */
	public function testGetNumber() {
		$this->assertEquals($this->object->getNumber(), 12);
	}

	/**
	 * @todo Implement testGetSuit().
	 */
	public function testGetSuit() {
		$this->assertEquals($this->object->getSuit(), 'C');
	}

	/**
	 * @todo Implement test__toString().
	 */
	public function test__toString() {
		$this->assertEquals($this->object->__toString(), 'C12');
	}
}
?>
