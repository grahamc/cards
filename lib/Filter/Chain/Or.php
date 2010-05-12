<?php
class Filter_Chain_Or extends Filter_Chain {

	public function test(array $existing_cards, array $new_cards) {
		foreach ($this->filters as $filter) {
			try {
				// The first one that doesn't fail returns true
				$filter->test($existing_cards, $new_cards);
				return true;
			} catch (Filter_Exception $e) {
				continue;
			}
		}

		// Throw the last failure's exception
		throw $e;
	}
}