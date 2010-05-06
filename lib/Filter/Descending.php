<?php
class Filter_Descending extends Filter {
	/**
	 * Make sure that the cards go in descending order
	 * @param array $cards
	 * @return array of cards
	 */
	public function attempt(Card $old, Card $new) {
		if ($old->getNumber() <= $new->getNumber()) {
			throw new Filter_Descending_Exception();
		}
	}
}