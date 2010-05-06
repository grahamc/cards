<?php
class Filter_Fail extends Filter {

	public function attempt(Card $old, Card $new) {
		throw new Filter_Fail_Exception();
	}
}