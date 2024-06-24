<?php

namespace App\Service;

use App\Config\CardConfig;
use App\Model\Card;

class CardService
{
    public function initializeCards(): array
    {

        $cards = [];

        foreach (CardConfig::COLORS as $color) {
            foreach (CardConfig::VALUES as $value) {
                $cards[] = new Card($color, $value);
            }
        }
        shuffle($cards);

        return $cards;
    }

    public function drawHand(array $cards, int $cardsNumber = CardConfig::HAND_SIZE): array
    {
        return array_slice($cards, 0, $cardsNumber);
    }

    public function sortHand(array $hand, array $colorOrder = null, string $sortOrder = 'asc'): array
    {
        $colorOrder = $colorOrder ?: CardConfig::COLORS;
        $valueOrder = $sortOrder === 'desc' ? array_reverse(CardConfig::VALUES) : CardConfig::VALUES;

        usort($hand, $this->getComparisonFunction($colorOrder, $valueOrder));

        return $hand;
    }

    private function getComparisonFunction(array $colorOrder, array $valueOrder): callable
    {
        $colorOrderMap = array_flip($colorOrder);
        $valueOrderMap = array_flip($valueOrder);

        return function (Card $a, Card $b) use ($colorOrderMap, $valueOrderMap) {
            $aColorIndex = $colorOrderMap[$a->getColor()];
            $bColorIndex = $colorOrderMap[$b->getColor()];

            if ($aColorIndex === $bColorIndex) {
                $aValueIndex = $valueOrderMap[$a->getValue()];
                $bValueIndex = $valueOrderMap[$b->getValue()];

                return $aValueIndex <=> $bValueIndex;
            }

            return $aColorIndex <=> $bColorIndex;
        };
    }

}
