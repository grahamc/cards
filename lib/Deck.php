<?php

class Deck implements Serializable {
    protected $cards = array();

    public function __construct() {
        foreach (Card::$valid_suits as $suit) {
            foreach (Card::$valid_numbers as $number) {
                $this->cards[] = new Card($suit, $number);
            }
        }
    }

    public function serialize() {
        return serialize($this->cards);
    }

    public function unserialize($data) {
        $this->cards = unserialize($data);
    }

    public function shuffle() {
        shuffle($this->cards);
    }

    public function getCards() {
        return $this->cards;
    }
}
