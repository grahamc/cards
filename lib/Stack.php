<?php
class Stack implements Countable {
	protected $cards = array();
	protected $filters = array();
	
	protected $filters_enabled = true;

	/**
	 * Initialize a stack and add cards
	 * @param $cards array array(Card, Card, ...)
	 */
	public function __construct(array $cards = array()) {
		foreach ($cards as $card) {
			if ($card instanceof Card) {
				$this->cards[] = $card;
			}
		}
	}
	
	public function count() {
	    return count($this->cards);
	}

	/**
	 * Add a filter to the stack
	 * @param Filter $filter 
	 */
	public function addFilter(Filter $filter) {
		$this->filters[] = $filter;
	}

	public function disableFilters() {
		$this->filters_enabled = false;
	}

	public function enableFilters() {
		$this->filters_enabled = true;
	}

	/**
	 * Add a stack of cards to the current stack
	 * @param Stack $stack
	 * @return bool
	 * @throws Validator_Exception
	 */
	public function add(Stack $stack) {
		$cards = $this->cards;

		if ($this->filters_enabled) {
			foreach($this->filters as $filter) {
				$filter->test($cards, $stack->getCards());
			}
		}

		foreach ($stack->getCards() as $card) {
			$cards[] = $card;
		}

		$this->cards = $cards;
		return true;
	}

	/**
	 * Get a stack of cards
	 * @param int $count Number of cards
	 * @return Stack a stack of cards
	 */
	public function pop($count) {
		// Get the cards off the end and stick them in a stack
		$cards = array_slice($this->cards, -$count);
		$stack = new Stack($cards);

		//  Remove the cards from this stack
		$this->cards = array_slice($this->cards, 0, -$count);
		
		return $stack;
	}

	public function getCards() {
		return $this->cards;
	}

	public function getFilters() {
		return $this->filters;
	}
}