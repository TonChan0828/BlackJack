<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Dealer;
use BlackJack\Player;
use BlackJack\RuleStep2;

use function PHPUnit\Framework\assertSame;

require __DIR__ . '/../lib/Dealer.php';

final class DealerTest extends TestCase
{
    public function testGetSumCards(): void
    {
        $deck = new Deck(range(0, 51));
        $dealer = new Dealer(new RuleStep2);
        $dealer->init($deck);
        assertSame(13, $dealer->getSumCards());
        $dealer->draw($deck);
        assertSame(20, $dealer->getSumCards());
    }

    public function testGetNumOfCards(): void
    {
        $deck = new Deck(range(0, 51));
        $dealer = new Dealer(new RuleStep2);
        assertSame(0, $dealer->getNumOfCards());
        $dealer->init($deck);
        assertSame(2, $dealer->getNumOfCards());
    }
}
