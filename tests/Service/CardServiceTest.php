<?php

namespace App\Tests\Service;

use App\Config\CardConfig;
use App\Model\Card;
use App\Service\CardService;
use PHPUnit\Framework\TestCase;

class CardServiceTest extends TestCase
{
    private CardService $cardService;

    protected function setUp(): void
    {
        $this->cardService = new CardService();
    }

    public function testInitializeCards(): void
    {
        $cards = $this->cardService->initializeCards();
        $this->assertCount(52, $cards);
        $this->assertInstanceOf(Card::class, $cards[0]);
    }

    public function testDrawHand(): void
    {
        $cards = $this->cardService->initializeCards();
        $hand = $this->cardService->drawHand($cards);
        $this->assertCount(10, $hand);

        foreach ($hand as $card) {
            $this->assertInstanceOf(Card::class, $card);
        }
    }

    public function testSortHand(): void
    {
        foreach(CardConfig::HAND_EXP as $card) {
            $hand[] = new Card($card["color"], $card["value"]);
    };
        $colorsOrder = CardConfig::COLORS;
        $order = CardConfig::SORT_VALUES_ORDERS[0];

        $sortedHand = $this->cardService->sortHand($hand, $colorsOrder, $order);

        $this->assertEquals('Diamonds', $sortedHand[0]->getColor());
        $this->assertEquals('Diamonds', $sortedHand[1]->getColor());
        $this->assertEquals('Diamonds', $sortedHand[2]->getColor());
        $this->assertEquals('Hearts', $sortedHand[3]->getColor());
        $this->assertEquals('Hearts', $sortedHand[4]->getColor());
        $this->assertEquals('Hearts', $sortedHand[5]->getColor());
        $this->assertEquals('Hearts', $sortedHand[6]->getColor());
        $this->assertEquals('Spades', $sortedHand[7]->getColor());
        $this->assertEquals('Spades', $sortedHand[8]->getColor());
        $this->assertEquals('Clubs', $sortedHand[9]->getColor());
    }
}
