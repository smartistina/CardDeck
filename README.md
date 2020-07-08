# OVERVIEW
Implement, using OOP paradigms, a simple management of a deck of cards.

# OBJECTIVES
1. Correctly model the data structures
2. Implementing the basic functionalities offered by abstraction

# SPECIFICATIONS
In this project we want to create a representation of a card deck and implement a set of features that allow interaction with it. The deck represents a set of cards that can be modified at any time.

### Class Card
It is the class that represents a single card. Each card is represented by its suit and a face value. It also has a back color.
### CardDeck class
It is the class that represents the entity "Bunch of Cards". A deck of cards contains within it a set of 52 cards divided into four suits of hearts, diamonds, clubs and spades. It also contains two wild cards (black and red).
The cards inside the deck have an order. The suits also have an order: hearts, diamonds, clubs, spades. In an ordered deck, the two Jokers are placed at the end of the deck (black and then red).
Each new instance of the class is initially empty, but you must provide the possibility to initialize its contents with a complete set of cards ordered by specifying the color of the back of the cards you want to place inside the deck. The sequence of the cards can be changed over time.
A deck must allow the following set of operations:
Inserting a card into the deck
○ On top of the bunch
Bottom of bunch
○ In a random place in the deck
● pulling out the next card in the sequence
Counting the cards left in the deck
Counting the cards left in the deck of a certain suit
Checking the presence of a certain card in the deck
shuffling the cards in the deck
Shuffling the cards in the deck
The cards are removed from the deck anyway.
### TESTING
In order to verify the correct implementation of the defined classes it is suggested to implement the necessary methods to provide a description of the entities by providing a representation in the form of a string.
