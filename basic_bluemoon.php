<?php
require_once 'bootstrap.php';


class Deck_BlueMoon_Stacked extends Deck_BlueMoon {
	public function shuffle() {
		parent::shuffle();
	}
}

$game = new Game();
$game->display();
$game->moveVisibleToDestination(0, 0);
$game->moveVisible(1, 1, 2);
$game->moveVisible(2, 2, 3);
$game->moveVisible(6, 2, 3);
$game->moveVisible(5, 1, 3);
$game->moveVisible(4, 1, 3);
$game->moveVisibleToDestination(6, 2);
$game->moveVisibleToDestination(1, 2);
$game->moveVisibleToDestination(2, 2);
$game->moveVisible(6, 1, 1);
$game->moveVisible(1, 2, 2);
$game->moveVisible(4, 1, 5);
$game->moveVisible(6, 1, 1);
$game->moveHiddenToVisible(6);
$game->moveVisibleToDestination(6, 1);
$game->moveHiddenToVisible(6);
$game->moveVisible(5, 4, 2);
$game->moveVisible(6, 1, 5);
$game->moveHiddenToVisible(6);
$game->moveVisible(5, 2, 0);
$game->moveHiddenToVisible(5);
$game->moveVisible(4, 3, 5);
$game->moveHiddenToVisible(4);
$game->moveVisible(3, 9, 5);
$game->moveVisible(2, 8, 3);
$game->moveVisibleToDestination(2, 3);
$game->moveHiddenToVisible(2);
$game->moveVisible(1, 3, 2);
$game->moveHiddenToVisible(1);
$game->moveVisible(3, 10, 4);
$game->moveVisibleToDestination(1, 0);
$game->moveVisibleToDestination(2, 1);
$game->moveVisibleToDestination(2, 1);
$game->moveHiddenToVisible(3);
$game->moveVisibleToDestination(3, 3);
$game->moveHiddenToVisible(3);
$game->moveVisible(2, 2, 3);
$game->moveHiddenToVisible(2);
$game->moveVisibleToDestination(2, 0);
$game->moveVisible(5, 3, 1);
$game->moveVisible(4, 2, 5);
$game->moveVisible(4, 1, 2);
$game->moveVisible(5, 6, 1);
$game->moveVisible(5, 1, 1);
$game->moveVisible(5, 2, 2);
$game->moveVisible(4, 4, 2);
$game->moveVisible(5, 1, 2);
$game->moveVisible(6, 1, 5);
$game->moveHiddenToVisible(6);
$game->moveVisible(5, 3, 0);
$game->moveHiddenToVisible(5);
$game->moveVisible(5, 1, 0);
$game->moveHiddenToVisible(5);
$game->moveVisible(5, 1, 6);
$game->moveHiddenToVisible(5);
$game->moveVisible(4, 4, 0);
$game->moveVisible(0, 2, 2);
$game->moveVisible(6, 2, 0);
$game->moveHiddenToVisible(4);
$game->moveHiddenToVisible(6);
$game->moveVisible(5, 1, 6);
$game->moveHiddenToVisible(5);
$game->moveVisible(4, 1, 0);
$game->moveHiddenToVisible(4);
$game->moveVisible(3, 3, 4);
$game->moveHiddenToVisible(3);
$game->moveVisible(4, 4, 6);
$game->moveHiddenToVisible(4);
$game->moveVisible(3, 1, 4);
$game->moveVisible(4, 2, 5);
$game->moveVisible(6, 6, 3);
$game->moveHiddenToVisible(6);
$game->moveVisible(5, 3, 6);
$game->moveVisible(6, 4, 3);


for ($i = 0; $i < 11; $i++) {
    $game->moveVisibleToDestination(0, 3);
}

for ($i = 0; $i < 11; $i++) {
    $game->moveVisibleToDestination(1, 2);
}

for ($i = 0; $i < 11; $i++) {
    $game->moveVisibleToDestination(2, 1);
}

for ($i = 0; $i < 11; $i++) {
    $game->moveVisibleToDestination(3, 0);
}

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

		$this->deck->getVisibleStack($stack)->disableFilters();
		$this->deck->getVisibleStack($stack)->add($cards);
		$this->deck->getVisibleStack($stack)->enableFilters();
		return true;
	}

	public function moveVisibleToDestination($stack, $to) {
		$cards = $this->deck->getVisibleStack($stack)->pop(1);
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
