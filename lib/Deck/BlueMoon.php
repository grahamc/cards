<?php
class Deck_BlueMoon extends Deck {

	protected $stacks = array('hidden' => array(), 'visible' => array(), 'destination' => array());

    public function serialize() {
        return serialize(array($this->cards, $this->stacks));
    }
    
    public function unserialize($data) {
        list($this->cards, $this->stacks) = unserialize($data);
    }
    
    public function isWon() {
        foreach ($this->stacks['hidden'] as $i => $stack) {
            if (count($stack) > 0) {
                return false;
            }
        }
        
        foreach ($this->stacks['visible'] as $stack) {
            if (count($stack) > 0) {
                return false;
            }
        }
        
        return true;
    }

	/**
	 *
	 * @param <type> $i
	 * @return Stack
	 */
	public function getVisibleStack($i) {
		return $this->stacks['visible'][$i];
	}

	/**
	 *
	 * @param <type> $i
	 * @return Stack
	 */
	public function getHiddenStack($i) {
		return $this->stacks['hidden'][$i];
	}

	/**
	 *
	 * @param <type> $i
	 * @return Stack
	 */
	public function getDestinationStack($i) {
		return $this->stacks['destination'][$i];
	}

	public function deal() {
		$cards_hidden = array();
		$cards_visible = array();
		$cards = $this->getCards();

		for ($i = 0; $i <= 6; $i++) {
			$cards_hidden[$i] = array();
		}

		for ($hold = 0; $hold <= 6; $hold++) {
			$cards_visible[$hold][] = current($cards);
			next($cards);

			for ($i = ($hold + 1); $i <= 6; $i++) {
				$cards_hidden[$i][] = current($cards);
				next($cards);
			}
		}

		$i = null;
		do {
			if ($i == null || $i > 6) {
				$i = 1;
			}

			$cards_visible[$i++][] = current($cards);
		} while ($card = next($cards));

		foreach ($cards_hidden as $stack_cards) {
			$this->stacks['hidden'][] = new Stack($stack_cards);
		}

		foreach ($cards_visible as $stack_cards) {
			$stack = new Stack($stack_cards);
			$stack->addFilter(new Filter_Sequential());
			$stack->addFilter(new Filter_Descending());
			$stack->addFilter(new Filter_SameSuit());
			$stack->addFilter(new Filter_BeginsWithKing());
			$this->stacks['visible'][] = $stack;
		}


		$stack = new Stack();
		$stack->addFilter(new Filter_Sequential());
		$stack->addFilter(new Filter_Ascending());
		$stack->addFilter(new Filter_SameSuit());
		$stack->addFilter(new Filter_BeginsWith1());
		for ($i = 0; $i <= 3; $i++) {	
			$this->stacks['destination'][] = clone $stack;
		}
	}

	public function getStacks() {
		return $this->stacks;
	}
}