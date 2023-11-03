import React, { useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar, faTrash, faEdit } from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';

function SongItem({ song, username, onDeleteSong, renderStars, onUpdateSong}) {
  const [isEditing, setIsEditing] = useState(false);
  const [newSongName, setNewSongName] = useState(song.song);
  const [newArtistName, setNewArtistName] = useState(song.artist);
  const [newRating, setNewRating] = useState(song.rating);

  const handleEdit = () => {
    setIsEditing(true);
  };

  const handleCancel = () => {
    setIsEditing(false);
  };

  const handleSave = async () => {
    try {
      const response = await axios.put('http://localhost:8080/index.php/rating/update', {
        artist: newArtistName,
        song: newSongName,
        rating: newRating,
        id: song.id,
      });
  
      if (response.data.success) {
        // Close the edit display
        setIsEditing(false);
        
        // Update the local state to reflect the new data
        setNewSongName(response.data.song);
        setNewArtistName(response.data.artist);
        setNewRating(response.data.rating);

  
        // Notify the parent component of the update (You can pass the updated data or just a flag)
        onUpdateSong(response.data);
  
      } else {
        // Handle errors or display an error message
      }
    } catch (err) {
      console.error("Error updating song:", err);
      // Handle errors or display an error message
    }
  };

  return (
    <div className="song-item">
      {isEditing ? (
        <div>
          <input
            type="text"
            value={newSongName}
            onChange={(e) => setNewSongName(e.target.value)}
          />
          <input
            type="text"
            value={newArtistName}
            onChange={(e) => setNewArtistName(e.target.value)}
          />
          <input
            type="number"
            value={newRating}
            onChange={(e) => setNewRating(e.target.value)}
          />
          <button onClick={handleSave}>Save</button>
          <button onClick={handleCancel}>Cancel</button>
        </div>
      ) : (
        <React.Fragment>
          <span>{newSongName}</span>
          <span>by {newArtistName}</span>
          {renderStars(newRating)}
          <div>
            {username === song.username && (
              <React.Fragment>
                <FontAwesomeIcon
                  icon={faEdit}
                  className="icon-button edit-icon"
                  onClick={handleEdit}
                />
                <FontAwesomeIcon
                  icon={faTrash}
                  className="icon-button delete-icon"
                  onClick={() => onDeleteSong(song.id)}
                />
              </React.Fragment>
            )}
          </div>
        </React.Fragment>
      )}
    </div>
  );
}

export default SongItem;
