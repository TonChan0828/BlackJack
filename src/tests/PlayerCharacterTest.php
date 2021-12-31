<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\PlayerCharacter;
use BlackJack\Player;
use BlackJack\RuleStep2;

use function PHPUnit\Framework\assertSame;

require __DIR__ . '/../lib/PlayerCharacter.php';

final class PlayerCharacterTest extends TestCase
{
    public function testGetSumCards(): void
    {
        $deck = new Deck(range(0, 51));
        $player = new PlayerCharacter(new RuleStep2);
        $player->init($deck);
        assertSame(13, $player->getSumCards());
        //3回ドロ-する
        $player->oneDraw($deck);
        $player->oneDraw($deck);
        $player->oneDraw($deck);
        assertSame(15, $player->getSumCards());
    }
}
