<?php

class Card implements Serializable {
	public static $valid_suits = array('H', 'S', 'C', 'D');
	public static $valid_numbers = array(1,2,3,4,5,6,7,8,9,10,11,12,13);

	public function __construct($suit, $number) {
		if (in_array($suit, Card::$valid_suits)) {
			$this->suit = $suit;
		} else {
			throw new Card_Exception_Suit();
		}

		if (in_array($number, Card::$valid_numbers)) {
			$this->number = $number;
		} else {
			throw new Card_Exception_Number();
		}
	}

    public function serialize() {
        return serialize(array($this->suit, $this->number));
    }
    
    public function unserialize($data) {
        list($this->suit, $this->number) = unserialize($data);
    }

	public function getNumber() {
		return $this->number;
	}

	public function getSuit() {
		return $this->suit;
	}

	public function __toString() {
		return $this->getSuit() . $this->getNumber();
	}
}