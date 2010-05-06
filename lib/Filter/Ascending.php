<?php
class Filter_Ascending extends Filter {
	/**
	 * Make sure that the cards go in ascending order
	 * @param array $cards
	 * @return array of cards
	 */
	public function attempt(Card $old, Card $new) {
		if ($old->getNumber() >= $new->getNumber()) {
			throw new Filter_Ascending_Exception();
		}
	}
}