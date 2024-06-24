<?php

namespace App\Controller;

use App\Config\CardConfig;
use App\Exception\ValidationException;
use App\Form\SortHandType;
use App\Model\Card;
use App\Response\JsonResponse;
use App\Service\CardService;
use App\Service\SerializationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use OpenApi\Attributes  as OA;
class CardController extends AbstractController
{
    private CardService $cardService;
    private SerializationService $serializationService;
    private FormFactoryInterface $formFactory;

    public function __construct(
        CardService $cardService,
        SerializationService $serializationService,
        FormFactoryInterface $formFactory)
    {
        $this->cardService = $cardService;
        $this->serializationService = $serializationService;
        $this->formFactory = $formFactory;
    }

    /**
     * Draw a random hand of 10 cards and return as JSON response.
     */
    #[OA\Get(
        path: "/api/draw-hand",
        summary: "Draw a random hand of 10 cards",
        tags: ["Card"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        type: "object",
                        example: CardConfig::HAND_EXP
                    )
                )
            )
        ]
    )]
    #[Route('/api/draw-hand', methods: ['GET'])]
    public function getCardsAction(): JsonResponse
    {
        $cards = $this->cardService->initializeCards();
        $handToDraw = $this->cardService->drawHand($cards);

        return new JsonResponse($this->serializationService, $handToDraw);
    }

    /**
     * Sort a given hand of cards and return as JSON response.
     */
    #[OA\Post(
        path: "/api/sort-hand",
        summary: "Sort a given hand of cards",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: "object",
                example: [
                    "hand" => CardConfig::HAND_EXP,
                    "colorOrder" => CardConfig::COLORS,
                    "sortOrder" => CardConfig::SORT_VALUES_ORDERS[0],
                ]
            )
        ),
        tags: ["Card"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",

            ),
            new OA\Response(
                response: 400,
                description: "Validation error",

            )
        ]
    )]
    #[Route('/api/sort-hand', methods: ['POST'])]
    public function sortHandAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->formFactory->create(SortHandType::class);
        $form->submit($data);

        if (!$form->isValid()) {
            $errors = $form->getErrors(true, true);
            throw new ValidationException((string) $errors);
        }
        $validatedData = $form->getData();
        $hand = array_map(fn($card) => new Card($card['color'], $card['value']), $validatedData['hand']);
        $colorOrder = $validatedData['colorOrder'] ?? null;
        $sortOrder = $validatedData['sortOrder'] ?? 'asc';

        $sortedHand = $this->cardService->sortHand($hand, $colorOrder, $sortOrder);

        return new JsonResponse($this->serializationService, $sortedHand);
    }
}

