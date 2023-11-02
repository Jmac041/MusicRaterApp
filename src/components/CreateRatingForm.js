// CreateRatingForm.js
import React, { useState } from 'react';

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

    // Call the onCreateRating function to create a new rating
    onCreateRating(songData);
    resetForm();
  }

  const resetForm = () => {
    setSongName('');
    setArtistName('');
    setRating(0);
    setErrorMessage(''); // Clear the error message
  };

  return (
    <div>
      <h1>Song Rater</h1>
      {errorMessage && <p style={{ color: 'red' }}>{errorMessage}</p>} {/* Display error message */}
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