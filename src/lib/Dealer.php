<?php

namespace BlackJack;

use BlackJack\Deck;
use BlackJack\Rule;

require_once(__DIR__ . '/Player.php');

class Dealer implements Player
{
    private const BORDER = 17;
    private array $cards = [];
    private int $sumCards;
    private string $name = 'ディーラー';

    public function __construct(private Rule $rule)
    {
        $this->sumCards = 0;
    }

    public function init(Deck $deck): void
    {
        $this->cards[] = $deck->draw();
        $this->sumCards += $this->cards[0]->getRank();
        $this->cards[] = $deck->draw();
        $this->sumCards += $this->cards[1]->getRank();
        echo 'ディーラーの引いたカードは' . $this->cards[0]->getCardInfo()['mark'] . 'の' . $this->cards[0]->getCardInfo()['num'] . 'です。' . PHP_EOL;
        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
        sleep(1);
    }

    public function draw(Deck $deck): void
    {
        echo 'ディーラーの引いた2枚目のカードは' . $this->cards[1]->getCardInfo()['mark'] . 'の' . $this->cards[1]->getCardInfo()['num'] . 'です。' . PHP_EOL;
        echo 'ディーラーの現在の得点は' . $this->sumCards . 'です。' . PHP_EOL;
        while ($this->sumCards < self::BORDER) {
            $this->oneDraw($deck);
            echo 'ディーラーの引いたカードは' . end($this->cards)->getCardInfo()['mark'] . 'の' . end($this->cards)->getCardInfo()['num'] . 'です。' . PHP_EOL;
            $this->getSumCards();
            echo 'ディーラーの現在の得点は' . $this->sumCards . 'です。' . PHP_EOL;
            sleep(1);
        }
    }

    public function oneDraw(Deck $deck): void
    {
        $this->cards[] = $deck->draw();
        //$this->sumCards += end($this->cards)->getRank();
    }

    public function getSumCards(): int
    {
        $this->sumCards = $this->rule->getSumCards($this->cards);
        return $this->sumCards;
    }

    public function getPlayerName(): string
    {
        return $this->name;
    }

    public function getNumOfCards(): int
    {
        return count($this->cards);
    }
}
