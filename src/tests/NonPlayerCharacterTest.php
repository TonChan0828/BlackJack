<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\NonPlayerCharacter;
use BlackJack\Player;
use BlackJack\RuleStep2;

use function PHPUnit\Framework\assertSame;

require __DIR__ . '/../lib/NonPlayerCharacter.php';

final class NonPlayerCharacterTest extends TestCase
{
    public function testGetSumCards(): void
    {
        $deck = new Deck(range(0, 51));
        $npc = new NonPlayerCharacter(new RuleStep2, 'npc1');
        $npc->init($deck);
        assertSame(13, $npc->getSumCards());
        $npc->draw($deck);
        assertSame(20, $npc->getSumCards());
    }

    public function testGetNumOfCards(): void
    {
        $deck = new Deck(range(0, 51));
        $npc = new NonPlayerCharacter(new RuleStep2, 'npc1');
        assertSame(0, $npc->getNumOfCards());
        $npc->init($deck);
        assertSame(2, $npc->getNumOfCards());
    }

    public function testGetPlayerName(): void
    {
        $npc = new NonPlayerCharacter(new RuleStep2, 'npc');
        assertSame('npc', $npc->getPlayerName());
    }
}
