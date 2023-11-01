<?php
    session_start();

    include "config.php";

    //Entry point for REST API
    require "inc/bootstrap.php";
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // CORS Headers
    header('Access-Control-Allow-Origin:*');
    $uri = explode( '/', $uri );

    // UserController Actions
    if ($uri[2] == 'user') {
        require "Controller/Api/UserController.php";
        $objFeedController = new UserController();
        $strMethodName = $uri[3] . 'Action';
        $objFeedController->{$strMethodName}();    
    } 
    
    // RatingController Actions
    elseif ($uri[2] == 'rating') {
        require "Controller/Api/RatingController.php";
        $objRatingController = new RatingController();
        $strMethodName = $uri[3] . 'Action';
        $objRatingController->{$strMethodName}();
    }
    
?>
