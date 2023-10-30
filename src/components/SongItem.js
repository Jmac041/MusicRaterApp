import React from 'react';

function SongItem({ song, onDeleteSong }) {
    return (
        <div className="song-item">
            <span>{song.name} - {song.rating} stars</span>
            <button onClick={() => onDeleteSong(song.id)}>Delete</button>
            {/* Add an Edit button here if needed */}
        </div>
    );
}

export default SongItem;
