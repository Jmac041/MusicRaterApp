import React from 'react';
import SongItem from './SongItem';

function SongList({ songs, onDeleteSong }) {
    return (
        <div className="song-list">
            {songs.map(song => (
                <SongItem 
                    key={song.id} 
                    song={song} 
                    onDeleteSong={onDeleteSong} 
                    // Pass more props if needed, for example for updating
                />
            ))}
        </div>
    );
}

export default SongList;
