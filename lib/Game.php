<?php

class Game implements Serializable {
	/**
	 * @var Deck
	 */
	protected $deck = null;

	public function __construct() {
		$deck = new Deck_BlueMoon();
		$deck->shuffle();
		$deck->deal();
		$this->deck = $deck;
	}
	
	public function getDeck() {
	    return $this->deck;
	}
	
	public function serialize() {
	    return serialize($this->deck);
	}
	
	public function unserialize($data) {
	    $this->deck = unserialize($data);
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
			$this->deck->getVisibleStack($stack)->disableFilters();
			$this->deck->getVisibleStack($stack)->add($cards);
			$this->deck->getVisibleStack($stack)->enableFilters();
			throw $e;
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
		
		$out = '';
		for ($i = 0; $i <= 6; $i++) {
			$h = $this->deck->getHiddenStack($i)->getCards();
			$out .= $i . "\t";
			$out .= str_repeat('#', count($h)) . "\t";

			foreach ($this->deck->getVisibleStack($i)->getCards() as $card) {
				$out .= $card . "\t";
			}

			$out .= "\r\n";
		}
		echo shell_exec('echo ' . escapeshellarg($out) . ' | column -tx -s \t');

	}
}