<?php

abstract class Filter {
	/**
	 * Filter the cards
	 * @param array $existing_cards Array of cards to validate
	 * @param array $new_cards Array of cards to validate
	 * @throws Filter_Exception
	 */
	public function test(array $existing_cards, array $new_cards) {
		$old = end($existing_cards);
		$new = reset($new_cards);

		if ($old instanceof Card && $new instanceof Card) {
			$this->attempt($old, $new);
		}

		return true;
	}

	abstract protected function attempt(Card $old, Card $new);
}