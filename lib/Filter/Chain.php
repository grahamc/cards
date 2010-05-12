<?php
abstract class Filter_Chain extends Filter {
	protected $filters = array();

	public function addFilter(Filter $filter) {
		$this->filters[] = $filter;
	}

	public function getFilters() {
		return $this->filters;
	}

	protected function attempt(Card $old, Card $new) {
		return true;
	}
}