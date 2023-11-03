import React, { useState } from 'react';
import axios from 'axios';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

function CreateRatingForm({ onCreateRating, session_username }) {
  const [songName, setSongName] = useState('');
  const [artistName, setArtistName] = useState('');
  const [rating, setRating] = useState(0);
  const [errorMessage, setErrorMessage] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
  
    const songData = {
      username: session_username,
      artist: artistName,
      song: songName,
      rating: rating,
    };
  
    // Move the axios request to create a rating here
    axios
      .post('http://localhost:8080/index.php/rating/create', songData)
      .then(response => {
        onCreateRating(response.data); // Call the onCreateRating callback passed from App.js
        resetForm();
  
        // Display a success notification
        if (response.data.success) {
          toast.success('Song added successfully', {
            position: 'top-right',
            autoClose: 3000,
          });
        } else {
            // Error notification
            toast.error('You have already rated this song', {
              position: 'top-right',
              autoClose: 3000,
            });
        }
      })
      .catch(error => {
        if (error.response && error.response.status === 400) {
          toast.error('You have already rated this song.', {
            position: 'top-right',
            autoClose: 3000,
          })
        } else {
          console.error("Error creating rating:", error);
  
          // Display an error notification
          toast.error('Failed to create song. Please try again.', {
            position: 'top-right',
            autoClose: 3000,
          });
        }
      });
  };

  const resetForm = () => {
    setSongName('');
    setArtistName('');
    setRating(0);
    setErrorMessage('');
  };

  return (
    <div>
      <ToastContainer />
      <h1>Song Rater</h1>
      {errorMessage && <p style={{ color: 'red' }}>{errorMessage}</p>}
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Song Name"
          value={songName}
          onChange={(e) => setSongName(e.target.value)}
          required
        />
        <input
          type="text"
          placeholder="Artist Name"
          value={artistName}
          onChange={(e) => setArtistName(e.target.value)}
          required
        />
        <input
          type="number"
          min="1"
          max="5"
          placeholder="Rating (1-5)"
          value={rating}
          onChange={(e) => setRating(e.target.value)}
          required
        />
        <button type="submit">Add Song</button>
        <button type="button" onClick={resetForm}>
          Cancel
        </button>
      </form>
    </div>
  );
}

export default CreateRatingForm;
