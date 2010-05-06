<?php
class Filter_Sequential extends Filter {
	public function attempt(Card $old, Card $new) {
		$diff = $old->getNumber() - $new->getNumber();
		if (abs($diff) != 1) {
			throw new Filter_Sequential_Exception();
		}
	}
}