<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\RuleStep2;

require __DIR__ . '/../lib/RuleStep2.php';

final class RuleStep2Test extends TestCase
{
    public function testGetSumCards(): void
    {
        $rule = new RuleStep2();
        $cards1 = [];
        $cards1[] = new Card(0);
        $cards1[] = new Card(9);
        $this->assertSame(21, $rule->getSumCards($cards1));

        $cards2 = [];
        $cards2[] = new Card(0);
        $cards2[] = new Card(9);
        $cards2[] = new Card(7);
        $this->assertSame(19, $rule->getSumCards($cards2));

        $cards3 = [];
        $cards3[] = new Card(0);
        $cards3[] = new Card(13);
        $cards3[] = new Card(7);
        $this->assertSame(20, $rule->getSumCards($cards3));

        $cards4 = [];
        $cards4[] = new Card(0);
        $cards4[] = new Card(13);
        $this->assertSame(12, $rule->getSumCards($cards4));

        $cards5 = [];
        $cards5[] = new Card(0);
        $cards5[] = new Card(12);
        $cards5[] = new Card(26);
        $this->assertSame(22, $rule->getSumCards($cards5));
    }
}
