<?php
class Filter_SameSuit extends Filter {
	/**
	 * Make sure that the cards go in ascending order
	 * @param array $cards
	 * @return array of cards
	 */
	public function attempt(Card $old, Card $new) {
		if ($old->getSuit() !== $new->getSuit()) {
			throw new Filter_Suit_Exception();
		}
	}
}