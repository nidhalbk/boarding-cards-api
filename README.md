the API mast not be called using the http request, so I have used the symfony service that can be shared with all component in the same symfony app.

I didn't test the docker config because I have same problem with docker and Apple silicone cpu in my mac.

to test this API I have created a new test case, and it can be tested by using this command:

`php bin/phpunit tests/BoardingCardSorterTest.php`

the logic of this test is to make unordered list of boarding cards and use the sort method in the SortBoardingCardsService class and finally compare the expected output with the generated the output using generateJourneyList method