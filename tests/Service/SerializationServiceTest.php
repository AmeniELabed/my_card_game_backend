<?php

namespace App\Tests\Service;

use App\Model\Card;
use App\Service\SerializationService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class SerializationServiceTest extends TestCase
{
    private SerializerInterface $serializer;
    private SerializationService $serializationService;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->serializationService = new SerializationService($this->serializer);
    }

    public function testSerialize(): void
    {
        $data = [new Card('Hearts', '2')];
        $json = '[{"color":"Hearts","value":"2"}]';

        $this->serializer->method('serialize')->willReturn($json);

        $result = $this->serializationService->serialize($data);
        $this->assertEquals($json, $result);
    }
}
