# FaveTune
Third homework assignment for COMP333: a music rater app called FaveTune developed by Jackson McAvoy and Naomy Chepngeno


# How it works
This is a music rating app that allows user to create,read, update and delete song ratings. It was created using JavaScript/ React frontend  and a PHP/MYSQL backend which communicate via REST API. <br>
The application first asks the user to either create an account or login with their username and password. After loggin in the user is given an option to create a song rating which will be displayed in a list. The list has edit and delete options that allow the user to either delete or edit the song ratings they submitted.

# Development

### Clone the repository below: 
https://github.com/Jmac041/MusicRaterApp

### Set up PHP/MYSQL Backend:

- Install XAMPP and start the MySQL and Apache servers
- Create the database and tables using the provided SQL queries.
  - For example, create a database called music-db with a two tables(users_table, ratings_table). Add 5 columns to the ratings_table(id, username,artist, song,rating) and two columns to the users_table(username, password)

### Set up Frontend:
- Navigate to the frontend directory on your terminal.
-  To install dependencies, run :
### `npm install`
- Next, start the development server by running:
### `npm start`
## Accessing the application:

The React frontend will be available at: http://localhost:3000 <br>

The PHP backend API will be accessible via the Apache server (usually on http://localhost or http://localhost:80, depending on your XAMPP settings).

## MVC architecturer and REST API

## Backend structure:
Our application follows the MVC (Model-View-Controller)  as described below:<br>
- **Controller**-Handles routing commands to the models
    * **BaseController.php**- Abstract class providing shared functionality for all controllers.
    * **RatingController.php**-Manages the requests related to user ratings, like adding or retrieving a rating.
    * **UserController.php**-Handles user-related actions, including user registration and authentication.<br>
- **Model**- Manages data and business logic.The model interacts with the database to retrieve, insert, update, or delete data.
    * **Database.php**-Core database class for establishing connections and executing queries
    * **RatingModel.php**-Represents the rating data and contains logic for rating operations.
    * **UserModel.php**-Encapsulates user data and handles user-specific business logic and database interactions.
- **Inc**-holds essential initialization and configuration files
    * **bootstrap.php**-Sets up the application environment, auto-loads classes, and initializes services.
    * **config.php**-Contains configuration settings such as database credentials and API keys
- **Index.php**-primary entry point for REST API.
## Rest API

This section provides an overview of the REST API endpoints available in the application. Each endpoint's purpose, required input, and expected output are described.

### User Authentication and Management

### Login Endpoint Testing
- **Purpose**: Authenticates users and initiates a session.
- **URL**: `http://localhost:8080/index.php/user/login`
- **Method**: POST
- **Payload**: `{"username": "<USERNAME>", "password": "<PASSWORD>"}`
- **Expected Success Response**: `{"success": true}`
- **Expected Error Response**: `{"success": false, "error": "Incorrect username or password"}`

### User Creation (Sign Up) Endpoint Testing
- **Purpose**: Allows new users to create an account.
- **URL**: `http://localhost:8080/index.php/user/create`
- **Method**: POST
- **Payload**: `{"username": "<USERNAME>", "password": "<PASSWORD>"}`
- **Expected Success Response**: `{"success": true}`
- **Expected Error Response**: `{"success": false, "error": "<ERROR_MESSAGE>"}`

### Song Ratings Management

### Create Rating Endpoint Testing
- **Purpose**: Enables users to add a new song rating.
- **URL**: `http://localhost:8080/index.php/rating/create`
- **Method**: POST
- **Payload**: `{"username": "<USERNAME>", "artist": "<ARTIST_NAME>", "song": "<SONG_NAME>", "rating": <RATING>}`
- **Expected Success Response**: `{"success": true, ...<RATING_INFO>}`
- **Expected Error Response**: `{"success": false, "error": "<ERROR_MESSAGE>"}`

### Update Rating Endpoint Testing
- **Purpose**: Allows users to update an existing song rating.
- **URL**: `http://localhost:8080/index.php/rating/update`
- **Method**: PUT
- **Payload**: `{"id": <RATING_ID>, "artist": "<ARTIST_NAME>", "song": "<SONG_NAME>", "rating": <RATING>}`
- **Expected Success Response**: `{"success": true, "song": "<UPDATED_SONG_NAME>", "artist": "<UPDATED_ARTIST_NAME>", "rating": <UPDATED_RATING>}`
- **Expected Error Response**: `{"success": false, "error": "<ERROR_MESSAGE>"}`

### Delete Rating Endpoint Testing
- **Purpose**: Permits users to delete a song rating by its ID.
- **URL**: `http://localhost:8080/index.php/rating/delete`
- **Method**: DELETE
- **Payload**: `{"id": <RATING_ID>}`
- **Expected Success Response**: `{"success": true, "message": "Rating deleted successfully"}`
- **Expected Error Response**: `{"success": false, "error": "<ERROR_MESSAGE>"}`

### Display Ratings Endpoint Testing
- **Purpose**: Retrieves a list of all song ratings.
- **URL**: `http://localhost:8080/index.php/rating/list`
- **Method**: GET
- **Expected Success Response**: An array of ratings
- **Expected Error Response**: `{"success": false, "error": "<ERROR_MESSAGE>"}`



#### REST API TESTING

For manual testing, you can use tools like [Postman](https://www.postman.com/)  make requests to your API and validate the responses.



## Frontend structure:
- **Components:**-houses individiual User Interface elements and functionalities as listed below:
    * **CreateRatingForm.js**-A form component for users to submit new ratings for songs.
    * **login.js**-Contains the login interface and functionality, handling user authentication.
    * **Signup.js**-Provides a signup form for new users to create an account.
    * **SongItem.js**-A component that represents a single song item in a list, displaying details like title and artist
    * **SongList.js**-Compiles a list of `SongItem` components and manages the overall display of songs in the UI
- **App.js**-It defines the main structure and logic of the FaveTune Music Rater App. Handles user login, song ratings and listings.
- **Index.js**-Imports App.js
- **App.css**-styling app.js

## Extra App feature:

For our extra feature, we decided to do  **React notifications** .The notification system we set up  provides immediate feedback for user interactions using `react-toastify` and `react-notifications`.<br>


### How it works:
The notification system is integrated throughout the application. For example, when a user performs actions such as logging in, adding a rating, or encountering an error, the application will trigger a notification

To see the notifications, the user needs toperform any action within the app that triggers a notification such as creating an account, logging in, adding a song rating.Once the action is performed, a toast notification will appear in response to the event

#### Setup
To set up notifications in the app, we installed the folowing packages:
- [`react-toastify`](https://fkhadra.github.io/react-toastify/): Used for delivering toast notifications.
- [`react-notifications`](https://www.npmjs.com/package/react-notifications): Used for displaying alert notifications.


```bash
npm install react-toastify react-notifications




        

 






