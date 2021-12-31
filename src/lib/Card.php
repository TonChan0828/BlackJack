<?php

namespace BlackJack;

class Card
{
    private const MAX_NUMBER = 13;
    private const MARK = ['スペード', 'ハート', 'ダイヤ', 'クラブ'];
    private const NUMBER = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    private const CARD_RANK = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10
    ];
    private string $mark;
    private string $num;

    public function __construct(private int $number)
    {
        $this->mark = self::MARK[intval($number / self::MAX_NUMBER)];
        $this->num = self::NUMBER[($number % self::MAX_NUMBER)];
    }

    public function getCardInfo(): array
    {
        return ['mark' => $this->mark, 'num' => $this->num];
    }

    public function getRank(): int
    {
        return self::CARD_RANK[$this->num];
    }
}
