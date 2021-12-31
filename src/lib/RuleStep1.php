<?php

namespace BlackJack;

use BlackJack\Rule;
use BlackJack\Card;
use BlackJack\PlayerCharacter;
use BlackJack\Dealer;

require_once(__DIR__ . '/Rule.php');

class RuleStep1 implements Rule
{
    private const BURST = 22;

    public function __construct()
    {
    }

    public function compareHand(array $players): array
    {
        $winner = [];
        $player = $players[0];
        $dealer = $players[1];
        if ($player->getSumCards() >= self::BURST) {
            $winner[] = $dealer;
        } elseif ($dealer->getSumCards() >= self::BURST) {
            $winner[] = $player;
        } elseif ($player->getSumCards() > $dealer->getSumCards()) {
            $winner[] = $player;
        } elseif ($player->getSumCards() < $dealer->getSumCards()) {
            $winner[] = $dealer;
        }
        return $winner;
    }

    public function getSumCards(array $cards): int
    {
        $sumCards = 0;
        foreach ($cards as $card) {
            $sumCards += $card->getRank();
        }
        return $sumCards;
    }
}
