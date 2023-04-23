<?php

namespace App\Tests;

use App\Entity\BoardingCard;
use App\Service\SortBoardingCardsService;
use PHPUnit\Framework\TestCase;

class BoardingCardSorterTest extends TestCase
{
    public function testSort()
    {
        // Create unordered boarding cards
        $boardingCards = [
            new BoardingCard('bus','the airport bus', 'Barcelona', 'Gerona Airport'),
            new BoardingCard('flight','flight SK455 ', 'Gerona Airport', 'Stockholm','3A','Gate 45B','Baggage drop at ticket counter 344.'),
            new BoardingCard('flight','flight SK22', 'Stockholm', 'New York JFK','7B','Gate 22','Baggage will we automatically transferred from your last leg.'),
            new BoardingCard('train','train 78A', 'Madrid', 'Barcelona','45B'),
        ];

        // Instantiate BoardingCardSorter with unordered boarding cards
        $boardingCardSorter = new SortBoardingCardsService($boardingCards);

        // Sort boarding cards
        $sortedBoardingCards = $boardingCardSorter->sort();


        // Define expected result
        $expectedResult = [
            'Take train 78A from Madrid to Barcelona. Sit in seat 45B.',
            'Take the airport bus from Barcelona to Gerona Airport. No seat assignment.',
            'From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.',
            'From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.',
            'You have arrived at your final destination.',
        ];

        // Assert that the sorted boarding cards match the expected result
        $this->assertEquals($expectedResult, $boardingCardSorter->generateJourneyList($sortedBoardingCards));
    }
}
