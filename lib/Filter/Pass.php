<?php
class Filter_Pass extends Filter {

	public function attempt(Card $old, Card $new) {
		return true;
	}
}