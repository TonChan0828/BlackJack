<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Deck;

require __DIR__ . '/../lib/Deck.php';

final class DeckTest extends TestCase
{
    public function testDraw(): void
    {
        $deck = new Deck(range(0,51));
        $card1 = $deck->draw();
        $this->assertSame(1, $card1->getRank());
        $card2 = $deck->draw();
        $this->assertSame(2, $card2->getRank());
    }
}
