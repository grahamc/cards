<?php
require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__).'/../../lib/Deck.php';

/**
 * Test class for Deck.
 * Generated by PHPUnit on 2010-05-06 at 08:46:05.
 */
class DeckTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var Deck
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Deck;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
	}

	/**
	 * @todo Implement testShuffle().
	 */
	public function testShuffle() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	public function testGetCards() {
		$this->assertEquals(count($this->object->getCards()), 52);
		$this->assertTrue(is_array($this->object->getCards()));
	}

	public function testGetCardsReturnsCards() {
		foreach ($this->object->getCards() as $card) {
			$this->assertTrue($card instanceof Card);
		}
	}
}
?>
