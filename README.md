# FaveTune
Jackson and Naomy's third homework assignment for COMP333: a music rater app called FaveTune 

# How it works
This is a music rating app that allows user to create,read, update and delete song ratings. It was created using JavaScript/ React frontend  and a PHP/MYSQL backend which communicate via REST API

# Development

### Clone the repository below: 
https://github.com/Jmac041/MusicRaterApp

### Set up PHP/MYSQL Backend:

- Install XAMPP and start the MySQL and Apache servers
- Create the database and tables using the provided SQL queries.

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

### Backend structure:
Our application follows the MVC (Model-View-Controller)  as described below:<br>
- **Controller**-Handles routing commands to the models
    * **BaseController.php**
    * **RatingController.php**
    * **UserController.php**
- **Model**- Manages data and business logic.The model interacts with the database to retrieve, insert, update, or delete data.
    * **Database.php**
    * **RatingModel.php**
    * **UserModel.php**
- **Inc**-holds essential initialization and configuration files
    * **bootstrap.php**
    * **config.php**
- **Index.php**-primary entry point for REST API.

### Frontend structure:
- **Components:**-houses individiual User Interface elements and functionalities as listed below:
    * **CreateRatingForm.js**
    * **login.js**
    * **Signup.js**
    * **SongItem.js**
    * **SongList.js**
- **App.js**-It defines the main structure and logic of the FaveTune Music Rater App. Handles user login, song ratings and listings.
- **Index.js**-Imports App.js
- **App.css**-styling app.js
        

 



