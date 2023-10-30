import React, { useState } from 'react';
import axios from 'axios';

function CreateRatingForm({ onAddSong }) {
    const [songName, setSongName] = useState('');
    const [rating, setRating] = useState(0);

    const handleSubmit = (e) => {
        e.preventDefault();

        const songData = {
            name: songName,
            rating: rating
        };

        // Calling onAddSong which is passed from App.js
        onAddSong(songData);

        // Reset the form
        setSongName('');
        setRating(0);
    };

    return (
        <form onSubmit={handleSubmit}>
            <input 
                type="text" 
                placeholder="Song Name"
                value={songName}
                onChange={(e) => setSongName(e.target.value)}
            />
            <input 
                type="number" 
                min="1" 
                max="5" 
                placeholder="Rating (1-5)"
                value={rating}
                onChange={(e) => setRating(e.target.value)}
            />
            <button type="submit">Add Song</button>
        </form>
    );
}

export default CreateRatingForm;
