<?php

class RatingModel extends Database
{
    public function getRatings()
    {
        // Need to implement the logic to retrieve all ratings
        $sql = "SELECT * FROM ratings_table";
        $ratings = $this->select($sql);
        return $ratings;
    }

    public function getRating($ratingId)
    {
        // Need to implement the logic to retrieve a specific rating by its ID
        $sql = "SELECT * FROM ratings_table WHERE id = ?";
        $rating = $this->select($sql, ["i", $ratingId]);

        if (count($rating) > 0) {
            return $rating[0];
        }

        return null;
    }

    public function createRating($username, $song, $rating)
    {
        // Need to implement the logic to create a new rating
        $sql = "INSERT INTO ratings_table (username, song, rating) VALUES (?, ?, ?)";
        $this->insert($sql, ["sss", $username, $song, $rating]);
    }

    public function updateRating($username, $song, $rating)
    {
        // Need to implement the logic to update an existing rating
        $sql = "UPDATE ratings_table SET rating = ? WHERE username = ? AND song = ?";
        $this->update($sql, ["sss", $rating, $username, $song]);
    }

    public function deleteRating($username, $song)
    {
        // Need to implement the logic to delete a rating
        $sql = "DELETE FROM ratings_table WHERE username = ? AND song = ?";
        $this->delete($sql, ["ss", $username, $song]);
    }
}
?>
