<?php
require_once 'lib/Card.php';
require_once 'lib/Card/Exception.php';
require_once 'lib/Card/Exception/Number.php';
require_once 'lib/Card/Exception/Suite.php';
require_once 'lib/Filter.php';
require_once 'lib/Filter/Exception.php';
require_once 'lib/Filter/Ascending.php';
require_once 'lib/Filter/Ascending/Exception.php';
require_once 'lib/Filter/Descending.php';
require_once 'lib/Filter/Descending/Exception.php';
require_once 'lib/Filter/Sequential.php';
require_once 'lib/Filter/Sequential/Exception.php';
require_once 'lib/Filter/SameSuit.php';
require_once 'lib/Filter/SameSuit/Exception.php';
require_once 'lib/Filter/BeginsWith1.php';
require_once 'lib/Filter/BeginsWith1/Exception.php';
require_once 'lib/Filter/BeginsWithKing.php';
require_once 'lib/Filter/BeginsWithKing/Exception.php';
require_once 'lib/Stack.php';
require_once 'lib/Deck.php';
require_once 'lib/Deck/BlueMoon.php';


class Deck_BlueMoon_Stacked extends Deck_BlueMoon {
	public function shuffle() {
		parent::shuffle();
	}
}

$game = new Game();

$game->moveVisibleToDestination(0, 1, 0);
$game->moveVisible(1, 1, 2);
$game->moveVisible(2, 2, 3);
$game->moveVisible(6, 2, 3);
$game->moveVisible(5, 1, 3);
$game->moveVisible(4, 1, 3);
$game->moveVisibleToDestination(6, 1, 2);
$game->moveVisibleToDestination(2, 2, 3);
$game->moveVisibleToDestination(2, 4, 3);
$game->moveHiddenToVisible(2);
$game->moveVisible(1, 4, 2);
$game->moveHiddenToVisible(1);
$game->moveVisibleToDestination(1, 1, 0);


$game->display();

class Game {
	/**
	 * @var Deck
	 */
	protected $deck = null;

	public function __construct() {
		$deck = new Deck_BlueMoon();
		$deck->deal();
		$this->deck = $deck;
	}

	public function describeVisibleSet($stack, $count) {
		$cards = $this->deck->getVisibleStack($stack)->pop($count);
		foreach ($cards as $card) {
			echo $card . "\r\n";
		}
		$this->deck->getVisibleStack($stack)->disableFilters();
		$this->deck->getVisibleStack($stack)->add($cards);
		$this->deck->getVisibleStack($stack)->enableFilters();
	}

	public function moveVisible($stack, $count, $to) {
		$cards = $this->deck->getVisibleStack($stack)->pop($count);
		try {
			$this->deck->getVisibleStack($to)->add($cards);
			return true;
		} catch (Filter_Exception $e) {
			echo 'Failure: ' . get_class($e) . "\r\n";
			$this->deck->getVisibleStack($stack)->disableFilters();
			$this->deck->getVisibleStack($stack)->add($cards);
			$this->deck->getVisibleStack($stack)->enableFilters();
			return false;
		}
	}

	public function moveHiddenToVisible($stack) {
		if (count($this->deck->getVisibleStack($stack)->getCards()) > 0) {
			return false;
		}

		if (count($this->deck->getHiddenStack($stack)->getCards()) == 0) {
			return false;
		}

		$cards = $this->deck->getHiddenStack($stack)->pop(1);

		$this->deck->getHiddenStack($stack)->disableFilters();
		$this->deck->getVisibleStack($stack)->add($cards);
		$this->deck->getHiddenStack($stack)->enableFilters();
		return true;
	}

	public function moveVisibleToDestination($stack, $count, $to) {
		$cards = $this->deck->getVisibleStack($stack)->pop($count);
		try {
			$this->deck->getDestinationStack($to)->add($cards);
			return true;
		} catch (Filter_Exception $e) {
			echo 'Failure: ' . get_class($e) . "\r\n";
			$this->deck->getVisibleStack($stack)->disableFilters();
			$this->deck->getVisibleStack($stack)->add($cards);
			$this->deck->getVisibleStack($stack)->enableFilters();
			return false;
		}
	}

	public function display() {
		echo "Done Stuff: ";
		for ($i = 0; $i < 4; $i++) {
			$stack = $this->deck->getDestinationStack($i);
			$cards = $stack->getCards();
			$card = end($cards);

			if ($card instanceof Card) {
				echo $card;
			} else {
				echo 'n/a';
			}

			echo '  ';
		}

		echo "\r\n";

		echo "In Play: \r\n";
		for ($i = 0; $i <= 6; $i++) {
			$h = $this->deck->getHiddenStack($i)->getCards();
			echo '-';
			echo str_repeat('#', count($h)) . ' ';

			foreach ($this->deck->getVisibleStack($i)->getCards() as $card) {
				echo $card . ' ';
			}

			echo "\r\n";
		}

	}
}