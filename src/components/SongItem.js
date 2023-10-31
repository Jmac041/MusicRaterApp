import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar, faTrash, faEdit } from '@fortawesome/free-solid-svg-icons';


function SongItem({ song, onDeleteSong, renderStars }) {
    return (
        <div className="song-item">
            <span>{song.name}</span> 
            {renderStars(song.rating)}
            <div>
                <FontAwesomeIcon 
                    icon={faEdit} 
                    className="icon-button edit-icon" 
                    // Add an onClick here if you want an edit functionality later
                />
                <FontAwesomeIcon 
                    icon={faTrash} 
                    className="icon-button delete-icon" 
                    onClick={() => onDeleteSong(song.id)}
                />
            </div>
        </div>
    );
}


export default SongItem;
