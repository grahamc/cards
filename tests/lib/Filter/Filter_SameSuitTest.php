<?php

/**
 * Test class for Filter_SameSuit.
 * Generated by PHPUnit on 2010-05-06 at 11:06:50.
 */
class Filter_SameSuitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Filter_SameSuit
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Filter_SameSuit;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testAttempt().
     */
    public function testAttempt()
    {
		$c1 = new Card('C', 1);
		$c2 = new Card('C', 2);

		$this->assertEquals($this->object->attempt($c1, $c2), null);
    }

	/**
     * @expectedException Filter_SameSuit_Exception
     */
    public function testAttemptFailure()
    {
		$c1 = new Card('C', 1);
		$c2 = new Card('D', 2);

		$this->object->attempt($c1, $c2);
    }
}
?>
