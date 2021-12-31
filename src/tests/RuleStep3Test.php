<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\NonPlayerCharacter;
use BlackJack\PlayerCharacter;
use BlackJack\RuleStep2;
use BlackJack\RuleStep3;

require __DIR__ . '/../lib/RuleStep3.php';

final class RuleStep3Test extends TestCase
{
    public function testGetSumCards(): void
    {
        $rule = new RuleStep3();
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

    public function testCompareHand(): void
    {
        $rule = new RuleStep3();
        $deck1 = new Deck([9, 10, 11, 12, 3, 4]);
        $player1 = new PlayerCharacter($rule);
        $player1->init($deck1);
        $npc1 = new NonPlayerCharacter($rule, 'npc');
        $npc1->init($deck1);
        $dealer1 = new Dealer($rule);
        $dealer1->init($deck1);
        $this->assertSame([$player1, $npc1], $rule->compareHand([$player1, $npc1, $dealer1]));

        $deck2 = new Deck([9, 10, 1, 2, 3, 4]);
        $player2 = new PlayerCharacter($rule);
        $player2->init($deck2);
        $npc2 = new NonPlayerCharacter($rule, 'npc');
        $npc2->init($deck2);
        $dealer2 = new Dealer($rule);
        $dealer2->init($deck2);
        $this->assertSame([$player2], $rule->compareHand([$player2, $npc2, $dealer2]));

        $deck3 = new Deck([9, 5, 1, 2, 0, 12]);
        $player3 = new PlayerCharacter($rule);
        $player3->init($deck3);
        $npc3 = new NonPlayerCharacter($rule, 'npc');
        $npc3->init($deck3);
        $dealer3 = new Dealer($rule);
        $dealer3->init($deck3);
        $this->assertSame([$dealer3], $rule->compareHand([$player3, $npc3, $dealer3]));

        $deck4 = new Deck([0, 3, 10, 4, 8, 5]);
        $player4 = new PlayerCharacter($rule);
        $player4->init($deck4);
        $npc4 = new NonPlayerCharacter($rule, 'npc');
        $npc4->init($deck4);
        $dealer4 = new Dealer($rule);
        $dealer4->init($deck4);
        $this->assertSame([], $rule->compareHand([$player4, $npc4, $dealer4]));
    }
}
