<?php

namespace BlackJack;

require_once(__DIR__ . '/Card.php');

class Deck
{
    private array $deck;
    public function __construct(array $deck)
    {
        //$this->deck = range(0, 51);
        //shuffle($deck);
        $this->deck = $deck;
    }

    public function draw(): Card
    {
        $card = array_shift($this->deck);
        if (is_int($card)) {
            return new Card($card);
        } else {
            exit('デッキが空なのでゲームを終了します。');
        }
    }
}
