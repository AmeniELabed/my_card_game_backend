<?php

namespace App\Service;

use Symfony\Component\Serializer\SerializerInterface;

class SerializationService
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize($data, array $groups = []): string
    {
        $context = ['groups' => $groups];
        return $this->serializer->serialize($data, 'json', $context);
    }
}
