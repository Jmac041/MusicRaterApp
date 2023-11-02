import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar, faTrash, faEdit } from '@fortawesome/free-solid-svg-icons';

function SongItem({ song, username, onDeleteSong, renderStars }) {
  return (
    <div className="song-item">
      <span>{song.song}</span>
      <span>by {song.artist}</span>
      {renderStars(song.rating)}
      <div>
        {username === song.username && (
          <React.Fragment>
            <FontAwesomeIcon
              icon={faEdit}
              className="icon-button edit-icon"
              // Add an onClick here if you want an edit functionality
            />
            <FontAwesomeIcon
              icon={faTrash}
              className="icon-button delete-icon"
              onClick={() => onDeleteSong(song.id)}
            />
          </React.Fragment>
        )}
      </div>
    </div>
  );
}

export default SongItem;
