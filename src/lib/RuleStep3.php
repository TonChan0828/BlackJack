<?php

namespace BlackJack;

use BlackJack\Rule;
use BlackJack\PlayerCharacter;
use BlackJack\Dealer;

require_once(__DIR__ . '/Rule.php');

class RuleStep3 implements Rule
{
    private const BURST = 22;
    private const ACE = 1;
    private const ELEVEN = 11;

    public function __construct()
    {
    }

    public function compareHand(array $players): array
    {
        $winner = [];
        $dealerWin = 0;
        $dealer = array_pop($players);
        foreach ($players as $player) {
            if ($player->getSumCards() >= self::BURST) {
                //$winner[] = $dealer;
                $dealerWin++;
            } elseif ($dealer->getSumCards() >= self::BURST) {
                $winner[] = $player;
            } elseif ($player->getSumCards() > $dealer->getSumCards()) {
                $winner[] = $player;
            } elseif ($player->getSumCards() < $dealer->getSumCards()) {
                //$winner[] = $dealer;
                $dealerWin++;
            }
        }
        if ((count($players) === $dealerWin) && ($dealer->getSumCards() < self::BURST)) {
            $winner[] = $dealer;
        }
        return $winner;
    }

    public function getSumCards(array $cards): int
    {
        $sumCards = 0;
        $hands = [];
        foreach ($cards as $card) {
            $hands[] = $card->getRank();
        }
        arsort($hands);
        foreach ($hands as $hand) {
            if ($hand === 1) {
                $tmpSum1 = $sumCards + self::ACE;
                $tmpSum2 = $sumCards + self::ELEVEN;
                $sumCards = $this->checkCards($tmpSum1, $tmpSum2);
            } else {
                $sumCards += $hand;
            }
        }
        return $sumCards;
    }

    private function checkCards(int $tmpSum1, int $tmpSum2): int
    {
        if (max($tmpSum1, $tmpSum2) >= self::BURST) {
            return min($tmpSum1, $tmpSum2);
        } else {
            return max($tmpSum1, $tmpSum2);
        }
    }
}
