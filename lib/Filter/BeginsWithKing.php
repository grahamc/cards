<?php
class Filter_BeginsWithKing extends Filter {
	/**
	 * Make sure that the cards go in ascending order
	 * @param array $cards
	 * @return array of cards
	 */
	public function test(array $existing_cards, array $new_cards) {
		$cards = $existing_cards + $new_cards;
		$first = reset($cards);


		if ($first->getNumber() != 13) {
			throw new Filter_BeginsWithKing_Exception();
		}

		return true;
	}

	// Skeletal
	public function attempt(Card $old, Card $new) {}
}