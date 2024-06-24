<?php

namespace App\Tests\Controller;

use App\Config\CardConfig;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerTest extends WebTestCase
{
    public function testGetCardsAction(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/draw-hand');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(10, $responseData);

        foreach ($responseData as $card) {
            $this->assertArrayHasKey('color', $card);
            $this->assertArrayHasKey('value', $card);
        }
    }

    public function testSortHandAction(): void
    {
        $client = static::createClient();
        $data = [
            'hand' => CardConfig::HAND_EXP,
            'colorOrder' => CardConfig::COLORS,
            'sortOrder' => CardConfig::SORT_VALUES_ORDERS[0]
        ];

        $client->request('POST', '/api/sort-hand', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(10, $responseData);

        $expectedColors = ['Diamonds', 'Diamonds', 'Diamonds', 'Hearts', 'Hearts', 'Hearts', 'Hearts', 'Spades', 'Spades', 'Clubs'];
        foreach ($responseData as $index => $card) {
            $this->assertEquals($expectedColors[$index], $card['color']);
        }
    }
}
