<?php

namespace BlackJack;

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Rule;

require_once(__DIR__ . '/Player.php');

class NonPlayerCharacter implements Player
{
    private array $cards = [];
    private int $sumCards;
    private string $name;
    private const BORDER = 17;

    public function __construct(private Rule $rule, private string $playerName)
    {
        $this->name = $playerName;
    }

    public function init(Deck $deck): void
    {
        $this->cards[] = $deck->draw();
        $this->cards[] = $deck->draw();
        foreach ($this->cards as $card) {
            $this->getSumCards();
            echo $this->name . 'の引いたカードは' . $card->getCardInfo()['mark'] . 'の' . $card->getCardInfo()['num'] . 'です。' . PHP_EOL;
            sleep(1);
        }
    }

    public function draw(Deck $deck): void
    {
        echo $this->name . 'の現在の得点は' . $this->sumCards . 'です。' . PHP_EOL;
        while ($this->sumCards < self::BORDER) {
            $this->oneDraw($deck);
            echo $this->name . 'の引いたカードは' . end($this->cards)->getCardInfo()['mark'] . 'の' . end($this->cards)->getCardInfo()['num'] . 'です。' . PHP_EOL;
            $this->getSumCards();
            echo $this->name . 'の現在の得点は' . $this->sumCards . 'です。' . PHP_EOL;
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
