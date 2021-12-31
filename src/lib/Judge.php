<?php

namespace BlackJack;

use BlackJack\Rule;
use BlackJack\PlayerCharacter;
use BlackJack\Dealer;

class Judge
{
    public function __construct(private Rule $rule)
    {
    }

    public function result(array $players): void
    {
        $winners = $this->compareHand($players);
        if (!empty($winners)) {
            foreach ($winners as $winner) {
                echo $winner->getPlayerName() . 'の勝ちです!' . PHP_EOL;
            }
        } else {
            echo '引き分けです。' . PHP_EOL;
        }
    }

    public function compareHand(array $players): array
    {
        //配列最後はディーラーとする
        return $this->rule->compareHand($players);
    }
}
