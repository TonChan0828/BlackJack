<?php

namespace BlackJack;

interface Rule
{
    public function compareHand(array $players): array;
    public function getSumCards(array $cards): int;
}
