<?php

namespace App\Config;

class CardConfig
{
    public const COLORS = ['Diamonds', 'Hearts', 'Spades', 'Clubs'];
    public const VALUES = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];
    public const SORT_VALUES_ORDERS  = ['asc', 'desc'];
    public const HAND_SIZE = 10;

    public const HAND_EXP = [
                                ["color" => "Hearts", "value" => "2"],
                                ["color" => "Spades", "value" => "King"],
                                ["color" => "Diamonds", "value" => "Ace"],
                                ["color" => "Hearts", "value" => "4"],
                                ["color" => "Diamonds", "value" => "5"],
                                ["color" => "Hearts", "value" => "10"],
                                ["color" => "Clubs", "value" => "8"],
                                ["color" => "Hearts", "value" => "Ace"],
                                ["color" => "Diamonds", "value" => "King"],
                                ["color" => "Spades", "value" => "7"]
    ];


}
