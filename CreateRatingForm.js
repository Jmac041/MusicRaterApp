import React, { useState } from 'react';

function CreateRatingForm({ onAddSong }) {
    const [songName, setSongName] = useState('');
    const [artistName, setArtistName] = useState('');
    const [rating, setRating] = useState(0);

    const handleSubmit = (e) => {
        e.preventDefault();

        const songData = {
            name: songName,
            artist: artistName,
            rating: rating
        };

        onAddSong(songData);

        resetForm();
    };

    const resetForm = () => {
        setSongName('');
        setArtistName('');
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
                type="text" 
                placeholder="Artist Name"
                value={artistName}
                onChange={(e) => setArtistName(e.target.value)}
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
            <button type="button" onClick={resetForm}>Cancel</button> {/* Reset button */}
        </form>
    );
}

export default CreateRatingForm;
