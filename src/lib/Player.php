<?php

namespace BlackJack;

use BlackJack\Deck;

interface Player
{
    public function init(Deck $deck): void;
    public function draw(Deck $deck): void;
    public function oneDraw(Deck $deck): void;
    public function getSumCards(): int;
    public function getPlayerName(): string;
    public function getNumOfCards(): int;
}
