<?php
/**
 * Make filters apply to the entire deck instead of just the glue
 */
class Filter_Deck extends Filter {
	protected $filter = null;

	public function __construct(Filter $filter) {
		$this->filter = $filter;
	}

	public function test(array $old, array $new) {
		$all_cards = $old + $new;

		foreach ($all_cards as $current_card) {
			if ($previous_card instanceof Card) {
				$this->filter->attempt($previous_card, $current_card);
			}

			$previous_card = $current_card;
		}
	}
}