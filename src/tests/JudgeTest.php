<?php

declare(strict_types=1);

namespace BlackJack\Tests;

use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\PlayerCharacter;
use PHPUnit\Framework\TestCase;
use BlackJack\RuleStep2;
use BlackJack\Judge;

use function PHPUnit\Framework\assertSame;

require_once(__DIR__ . '/../lib/RuleStep1.php');
require_once(__DIR__ . '/../lib/Judge.php');

final class JudgeTest extends TestCase
{
    public function testCompareHand(): void
    {
        $rule = new RuleStep2();
        $judge = new Judge($rule);
        $deck1 = new Deck([10, 11, 12, 7]);
        $player1 = new PlayerCharacter($rule);
        $player1->init($deck1);
        $dealer1 = new Dealer($rule);
        $dealer1->init($deck1);
        assertSame([$player1], $judge->compareHand([$player1, $dealer1]));   //20,18

        $deck2 = new Deck([10, 6, 9, 8]);
        $player2 = new PlayerCharacter($rule);
        $player2->init($deck2);
        $dealer2 = new Dealer($rule);
        $dealer2->init($deck2);
        assertSame([$dealer2], $judge->compareHand([$player2, $dealer2]));   //17,19

        $deck3 = new Deck([13, 17, 0, 4]);
        $player3 = new PlayerCharacter($rule);
        $player3->init($deck3);
        $dealer3 = new Dealer($rule);
        $dealer3->init($deck3);
        assertSame([], $judge->compareHand([$player3, $dealer3]));   //6,6

        $deck4 = new Deck([9, 10, 11, 5, 1, 8]);
        $player4 = new PlayerCharacter($rule);
        $player4->init($deck4);
        $dealer4 = new Dealer($rule);
        $dealer4->init($deck4);
        $player4->oneDraw($deck4);
        $dealer4->oneDraw($deck4);
        assertSame([$dealer4], $judge->compareHand([$player4, $dealer4]));  //22,25

    }
}
