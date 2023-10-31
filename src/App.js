import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './App.css';
import SongList from './components/SongList.js';
import CreateRatingForm from './components/CreateRatingForm.js';

function App() {
  const [songs, setSongs] = useState([]);
  const [username, setUsername] = useState('');

  useEffect(() => {
    // Fetch the username from local storage
    const loggedInUsername = localStorage.getItem('username');
    setUsername(loggedInUsername);
    
    axios.get('http://localhost/MusicRaterApp/read.php')
      .then(response => {
        setSongs(response.data);
      })
      .catch(error => {
        console.error("Error fetching songs:", error);
      });
  }, []);

  const logoutFunction = () => {
    // Your logout logic here, e.g., removing authentication tokens or clearing local storage
    localStorage.removeItem('username');
    // Redirect to login page or refresh the current page
    window.location.reload();
  };

  const addSong = (songData) => {
    setSongs(prevSongs => [...prevSongs, songData]);
  };

  const deleteSong = (songId) => {
    axios.delete(`http://localhost/MusicRaterApp/delete.php?id=${songId}`)
        .then(response => {
            setSongs(prevSongs => prevSongs.filter(song => song.id !== songId));
        })
        .catch(error => {
            console.error("Error deleting song:", error);
        });
  };

  return (
    <div className="App">
      <header className="App-header">
        <div className="user-info">
            <span>Username: {username}</span>
            <button onClick={logoutFunction} className="exit-button">Exit</button>
        </div>
        <h1>Song Rater</h1>
        <CreateRatingForm onAddSong={addSong} />
        <div>
            <h2>Songs List:</h2>
            <SongList songs={songs} onDeleteSong={deleteSong} />
        </div>
      </header>
    </div>
  );
}

export default App;
