<?php
namespace App\Model;

use Symfony\Component\Serializer\Annotation\Groups;

Class Card
{

    #[Groups(['default'])]
    private $color;

    #[Groups(['default'])]
    private $value;

    public function __construct($color, $value)
    {
        $this->color = $color;
        $this->value = $value;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getValue()
    {
        return $this->value;
    }
}