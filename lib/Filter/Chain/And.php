<?php
class Filter_Chain_And extends Filter_Chain {
	public function test(array $existing_cards, array $new_cards) {
		foreach ($this->filters as $filter) {
			$filter->test($existing_cards, $new_cards);
		}

		return true;
	}
}