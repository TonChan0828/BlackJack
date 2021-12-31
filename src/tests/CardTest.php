<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;

require __DIR__ . '/../lib/Card.php';

final class CardTest extends TestCase
{
    public function testGetCardInfo(): void
    {
        $card1 = new Card(13);
        $this->assertSame(['mark' => 'ハート', 'num' => '1'], $card1->getCardInfo());
        $card2 = new Card(38);
        $this->assertSame(['mark' => 'ダイヤ', 'num' => 'K'], $card2->getCardInfo());
        $card3 = new Card(4);
        $this->assertSame(['mark' => 'スペード', 'num' => '5'], $card3->getCardInfo());
        $card4 = new Card(50);
        $this->assertSame(['mark' => 'クラブ', 'num' => 'Q'], $card4->getCardInfo());
    }

    public function testGetRank(): void
    {
        $card1 = new Card(13);
        $this->assertSame(1, $card1->getRank());
        $card2 = new Card(11);
        $this->assertSame(10, $card2->getRank());
    }
}
