<?php

class Deck {
	protected $cards = array();

	public function __construct() {
		foreach (Card::$valid_suits as $suit) {
			foreach (Card::$valid_numbers as $number) {
				$this->cards[] = new Card($suit, $number);
			}
		}
	}

	public function shuffle() {
		shuffle($this->cards);
	}

	public function getCards() {
		return $this->cards;
	}
}