import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar, faTrash, faEdit } from '@fortawesome/free-solid-svg-icons';

import SongItem from './SongItem';

function SongList({ songs, onDeleteSong }) {

    const renderStars = (rating) => {
        let stars = [];
        for (let i = 0; i < rating; i++) {
            stars.push(<FontAwesomeIcon icon={faStar} key={i} />);
        }
        return stars;
    }

    return (
        <div className="song-list">
            {songs.map(song => (
                <SongItem 
                    key={song.id} 
                    song={song} 
                    onDeleteSong={onDeleteSong}
                    renderStars={renderStars}
                />
            ))}
        </div>
    );
}

export default SongList;
