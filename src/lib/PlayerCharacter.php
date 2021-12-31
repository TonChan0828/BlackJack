<?php

namespace BlackJack;

use BlackJack\Card;
use BlackJack\Deck;

require_once(__DIR__ . '/Player.php');

class PlayerCharacter implements Player
{
    private array $cards = [];
    private int $sumCards;
    private string $name = 'あなた';
    private const BURST = 22;

    public function __construct(private Rule $rule)
    {
        $this->sumCards = 0;
    }

    public function init(Deck $deck): void
    {
        $this->cards[] = $deck->draw();
        $this->cards[] = $deck->draw();
        foreach ($this->cards as $card) {
            $this->sumCards += $card->getRank();
            echo 'あなたの引いたカードは' . $card->getCardInfo()['mark'] . 'の' . $card->getCardInfo()['num'] . 'です。' . PHP_EOL;
            sleep(1);
        }
    }

    public function draw(Deck $deck): void
    {
        while ($this->sumCards < self::BURST) {
            echo 'あなたの現在の得点は' . $this->sumCards . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            if ($this->isDraw()) {
                $this->oneDraw($deck);
                echo 'あなたの引いたカードは' . end($this->cards)->getCardInfo()['mark'] . 'の' . end($this->cards)->getCardInfo()['num'] . 'です。' . PHP_EOL;
            } else {
                break;
            }
            sleep(1);
        }
    }

    public function oneDraw(Deck $deck): void
    {
        $this->cards[] = $deck->draw();
        $this->sumCards += end($this->cards)->getRank();
    }

    private function isDraw(): bool
    {

        while ($input = fgets(STDIN)) {
            if ($this->isYES($input)) {
                return true;
            } elseif ($this->isNO($input)) {
                return false;
            } else {
                echo '入力が正しくありません。カードを引きますか？(Y/N)' . PHP_EOL;
            }
        }
    }

    private function isYES(string $input): bool
    {
        if ((trim($input) === 'Y') || (trim($input) === 'y') || (trim($input) === 'YES') || (trim($input) === 'yes') || (trim($input) === 'Yes')) {
            return true;
        } else {
            return false;
        }
    }

    private function isNO(string $input): bool
    {
        if ((trim($input) === 'N') || (trim($input) === 'n') || (trim($input) === 'NO') || (trim($input) === 'no') || (trim($input) === 'No')) {
            return true;
        } else {
            return false;
        }
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
