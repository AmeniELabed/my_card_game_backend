<?php

namespace App\Response;

use App\Service\SerializationService;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends Response
{
    public function __construct(SerializationService $serializer, $data, array $groups = ['default'], int $status = 200, array $headers = [])
    {
        $jsonData = $serializer->serialize($data, $groups);
        parent::__construct($jsonData, $status, array_merge(['Content-Type' => 'application/json'], $headers));
    }
}