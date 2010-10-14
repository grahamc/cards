<?php
class Filter_BeginsWithKing extends Filter {
	/**
	 * Make sure that the cards go in ascending order
	 * @param array $cards
	 * @return array of cards
	 */
	public function test(array $existing_cards, array $new_cards) {
		// If we already have cards on the stack then don't worry about it
		if (count($existing_cards) > 0) {
			return true;
		}

		$first = reset($new_cards);


		if ($first->getNumber() != 13) {
			throw new Filter_BeginsWithKing_Exception();
		}

		return true;
	}

	// Skeletal
	public function attempt(Card $old, Card $new) {}
}