<?php

namespace App\Service;

use App\Entity\BoardingCard;

class SortBoardingCardsService
{
    /**
     * @var BoardingCard[]
     */
    private array $cards;

    public function __construct($cards)
    {
        $this->cards = $cards;
    }

    public function sort(): array
    {
        $mapping = $this->createMapping();
        $start = $this->findStart($mapping);

        $sortedCards = array($start);
        $currentCity = $start->destination;

        while (count($sortedCards) < count($this->cards)) {
            $nextCard = $mapping[$currentCity];
            $sortedCards[] = $nextCard;
            $currentCity = $nextCard->destination;
        }

        return $sortedCards;
    }

    private function createMapping():array
    {
        $mapping = array();
        foreach ($this->cards as $card) {
            $mapping[$card->source] = $card;
        }
        return $mapping;
    }

    private function findStart($mapping): BoardingCard
    {
        foreach ($this->cards as $card) {
            if (!isset($mapping[$card->destination])) {
                return $card;
            }
        }
        throw new \Error('No starting point in this list.');
    }

    /**
     * @param BoardingCard[] $sortedBoardingCards
     * @return string[]
     */
    public function generateJourneyList(array $sortedBoardingCards):array {
        $description = [];

        foreach ($sortedBoardingCards as $boardingCard) {
            $description[] = $boardingCard->getDescription();
        }

        $description[] = "You have arrived at your final destination.";

        return $description;
    }
}
