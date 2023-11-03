import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar } from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';

import SongItem from './SongItem';

function SongList({ songs, username, onDeleteSong, onUpdateSong}) {
  const renderStars = (rating) => {
    let stars = [];
    for (let i = 0; i < rating; i++) {
      stars.push(<FontAwesomeIcon icon={faStar} key={i} />);
    }
    return stars;
  }

  const handleDeleteSong = (songId) => {
    // Move the axios request to delete a song here
    axios
      .delete('http://localhost:8080/index.php/rating/delete', { data: { id: songId } })
      .then(response => {
        onDeleteSong(songId); // Call the onDeleteSong callback passed from App.js
      })
      .catch(error => {
        console.error("Error deleting song:", error);
      });
  };

  return (
    <div className="song-list">
      <h1>Ratings</h1>
      {username && songs.length > 0 ? (
        songs.map(song => (
          <SongItem
            key={song.id}
            song={song}
            username={username}
            onDeleteSong={handleDeleteSong} // Pass the new handler here
            renderStars={renderStars}
            onUpdateSong={onUpdateSong}
          />
        ))
      ) : (
        <p>No songs to display</p>
      )}
    </div>
  );
}

export default SongList;
