import React, { useState } from 'react';
import Rating from './Rating';

function CreateRatingForm({ addSong }) {
  const [name, setName] = useState(''); // Assuming you have a song name input.
  const [artist, setArtist] = useState(''); // New artist state.
  const [rating, setRating] = useState(0); // Assuming you have a rating input.

  const handleSubmit = (e) => {
    e.preventDefault();
    const songData = {
      name,
      artist, // New artist data.
      rating
    };
    addSong(songData);
    setName('');
    setArtist(''); // Reset the artist input after submission.
    setRating(0);
  };

  return (
    <form onSubmit={handleSubmit}>
      <input 
        type="text" 
        placeholder="Song Name" 
        value={name} 
        onChange={(e) => setName(e.target.value)} 
      />
      <input 
        type="text" 
        placeholder="Artist" 
        value={artist} 
        onChange={(e) => setArtist(e.target.value)} 
      />
      <Rating rating={rating} />
      <button type="submit">Submit</button>
    </form>
  );
}

export default CreateRatingForm;
