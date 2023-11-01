<?php
class RatingController extends BaseController
{
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
        if (strtoupper($requestMethod) == 'GET') {
            try {
                // Instantiate a RatingModel and call the getRatings method to fetch all ratings
                $ratingModel = new RatingModel();
                $ratings = $ratingModel->getRatings();
                $responseData = json_encode($ratings);
            } catch (Exception $e) {
                $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    
    public function viewAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            $ratingId = $_GET['id']; // Assuming the rating ID is passed as a query parameter
            if (empty($ratingId) || !is_numeric($ratingId)) {
                $strErrorDesc = 'Invalid rating ID';
                $strErrorHeader = 'HTTP/1.1 400 Bad Request';
            } else {
                try {
                    // Instantiate a RatingModel and call the getRating method to fetch a specific rating
                    $ratingModel = new RatingModel();
                    $rating = $ratingModel->getRating($ratingId);
                    if ($rating) {
                        $responseData = json_encode($rating);
                    } else {
                        $strErrorDesc = 'Rating not found';
                        $strErrorHeader = 'HTTP/1.1 404 Not Found';
                    }
                } catch (Exception $e) {
                    $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function createAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $postData = json_decode(file_get_contents('php://input'), true);
            //Instantiate a RatingModel
            $ratingModel = new RatingModel();
            try {
                // Call the createRating method
                $ratingModel->createRating($postData);
                $responseData = json_encode(array('message' => 'Rating created successfully'));
            } catch (Exception $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 201 Created')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function updateAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            $postData = json_decode(file_get_contents('php://input'), true);
            $ratingModel = new RatingModel();
            try {
                // Instantiate a RatingModel and call the updateRating method
                $ratingModel->updateRating($postData);
                $responseData = json_encode(array('message' => 'Rating updated successfully'));
            } catch (Exception $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function deleteAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $postData = json_decode(file_get_contents('php://input'), true);
            $ratingModel = new RatingModel();
            try {
                // Instantiate a RatingModel and call the deleteRating method
                $ratingModel->deleteRating($postData);
                $responseData = json_encode(array('message' => 'Rating deleted successfully'));
            } catch (Exception $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 204 No Content')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    // Add more functions as necessary
}
?>
