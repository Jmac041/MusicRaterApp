import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faStar } from '@fortawesome/free-solid-svg-icons';

import SongItem from './SongItem';

function SongList({ songs, username, onDeleteSong }) {
  const renderStars = (rating) => {
    let stars = [];
    for (let i = 0; i < rating; i++) {
      stars.push(<FontAwesomeIcon icon={faStar} key={i} />);
    }
    return stars;
  }

  return (
    <div className="song-list">
        <h1>Ratings</h1>
      {username && songs.length > 0 ? (
        songs.map(song => (
          <SongItem
            key={song.id}
            song={song}
            username={username}
            onDeleteSong={onDeleteSong}
            renderStars={renderStars}
          />
        ))
      ) : (
        <p>No songs to display</p>
      )}
    </div>
  );
}

export default SongList;
