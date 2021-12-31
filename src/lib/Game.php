<?php

namespace BlackJack;

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\PlayerCharacter;
use BlackJack\Dealer;
use BlackJack\NonPlayerCharacter;
use BlackJack\Judge;
use BlackJack\RuleStep1;
use BlackJack\RuleStep2;
use BlackJack\RuleStep3;

require __DIR__ . '/../lib/PlayerCharacter.php';
require __DIR__ . '/../lib/NonPlayerCharacter.php';
require __DIR__ . '/../lib/Dealer.php';
require __DIR__ . '/../lib/Deck.php';
require __DIR__ . '/../lib/RuleStep1.php';
require __DIR__ . '/../lib/RuleStep2.php';
require __DIR__ . '/../lib/RuleStep3.php';
require __DIR__ . '/../lib/Judge.php';

class Game
{
    private const RULE_STEP = 3;
    private Rule $rule;
    private array $cards;
    private Deck $deck;
    private array $players;

    public function __construct()
    {
    }

    public function start(): void
    {
        echo 'ゲームを開始します。' . PHP_EOL;
        $this->prepare();
        $this->playerSelect();
        $this->init();
        $this->draw();
        $this->judge();
        echo '終了します。' . PHP_EOL;
    }

    private function prepare(): void
    {
        $this->rule = $this->getRule(self::RULE_STEP);
        $this->cards = range(0, 51);
        shuffle($this->cards);
        $this->deck = new Deck($this->cards);
    }

    private function playerSelect(): void
    {
        $this->players[] = new PlayerCharacter($this->rule);
        $npc = ['NPC1', 'NPC2', 'NPC3'];
        while (1) {
            echo 'NPCを何人追加しますか？(最大3人まで)' . PHP_EOL;
            $numString = fgets(STDIN);
            $num = trim($numString);
            if (is_numeric($num)) {
                $numInt = intval($num);
                if (0 <= $numInt && $numInt <= 3) {
                    for ($i = 0; $i < $numInt; $i++) {
                        $this->players[] = new NonPlayerCharacter($this->rule, $npc[$i]);
                    }
                    break;
                } else {
                    echo '入力が正しくありません。もう一度入力してください。' . PHP_EOL;
                }
            } else {
                echo '入力が正しくありません。もう一度入力してください。' . PHP_EOL;
            }
        }
        $this->players[] = new Dealer($this->rule);
    }

    private function init(): void
    {
        foreach ($this->players as $player) {
            $player->init($this->deck);
            sleep(1);
        }
    }

    private function draw(): void
    {
        foreach ($this->players as $player) {
            $player->draw($this->deck);
            sleep(1);
        }
    }

    private function judge(): void
    {
        $judge = new Judge($this->rule);
        $judge->result($this->players);
        sleep(1);
    }

    public function getRule(int $rule): Rule
    {
        if ($rule === 1) {
            return new RuleStep1();
        } elseif ($rule === 2) {
            return new RuleStep2();
        } elseif ($rule === 3) {
            return new RuleStep3();
        }/* elseif ($rule === 4) {
            return new RuleStep4;
        }*/
    }
}

$game = new Game();
$game->start();
