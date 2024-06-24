# My Card Game Backend

This project is a Symfony-based backend application for a card game. It allows users to draw and sort a hand of cards.
## Installation

Follow these steps to set up the application:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/AmeniELabed/my_card_game_backend.git
    cd my_card_game_backend
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```


## Running the Application

To run the Symfony application locally:

```bash
symfony server:start
```
The application will be available at http://localhost:8000

## API Documentation

API documentation is generated using NelmioApiDocBundle.

To view the documentation: http://localhost:8000/api/doc.

## Running Tests

To run the unit and functional tests, run the command:

```bash
php bin/phpunit
```
## Project Structure
- #### config/: 
    - Contains all configuration files and directories.

- ####     public/:
  - The document root of the project. It is where the front controller is located.

- #### src/Config
  - **CardConfig.php**: Contains configuration constants or settings related to the card game, such as colors, values, and sorting orders.

- #### src/Controller
  - **CardController.php**: Handles HTTP requests related to card operations, such as drawing and sorting hands of cards.

- #### src/EventListener
  - **ExceptionListener.php**: An event listener that handles exceptions and customizes the response when an exception occurs, ensuring consistent error handling.

- #### src/Exception
  - **ValidationException.php**: Custom exception class that handles validation errors, providing a way to manage and respond to validation issues within the application.

- #### src/Form
    - **SortHandType.php**: Defines a Symfony form type for sorting a hand of cards. It handles the validation and mapping of form data to the model.

- #### src/Model
  - **Card.php**: Model class representing a card in the game, with properties such as `color` and `value`.

- #### src/Response
  - **JsonResponse.php**: Custom response class that extends Symfony's `Response` class, providing a way to return JSON responses with serialized data.

- #### src/Service
  - **CardService.php**: Service class that contains the business logic for card-related operations, such as initializing the deck, drawing a hand, and sorting cards.
  - **SerializationService.php**: Service that handles the serialization of objects to JSON, making it easier to return consistent JSON responses.

- #### src/Kernel.php
  - **Kernel.php**: Main application kernel class for the Symfony application. It handles the bootstrapping and configuration of the application.
      tests/: Contains the test cases for the application.
          Controller/: Contains tests for controllers.
          Service/: Contains tests for services.

- **.env**: Default environment variables.


- **.env.test**: Environment variables specific to the test environment.


- **.gitignore**: Specifies files and directories to be ignored by Git.


- **phpunit.xml.dist**: The PHPUnit configuration file.


- **README.md**: This readme file.
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
This `README.md` file provides a detailed explanation of the project structure, installation instructions, how to run the application, how to generate API documentation, and how to run tests. If you have any further questions or need additional assistance, feel free to ask!






