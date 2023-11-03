import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './App.css';
import SongList from './components/SongList.js';
import CreateRatingForm from './components/CreateRatingForm.js';
import Login from './components/Login';

function App() {
  const [songs, setSongs] = useState([]);
  const [username, setUsername] = useState('');
  
  const handleLogin = (loggedInUsername) => {
    // Set the username in the App component's state
    setUsername(loggedInUsername);
  };

  useEffect(() => {
      // Fetch songs
      axios.get('http://localhost:8080/index.php/rating/list')
        .then(response => {
          setSongs(response.data);
        })
        .catch(error => {
          console.error("Error fetching songs:", error);
        });
    
  }, []);

  const logoutFunction = () => {
    // Clear the stored username in local storage
    localStorage.removeItem('username');
    // Clear the username in the component state
    setUsername('');
  };


  
  return (
    <div className="App">
      <header className="App-header">
        <h1>FaveTune: Music Rater App</h1>
        {username ? (
          <div className="user-info">
            <span>Logged in as: {username}</span>
            <button onClick={logoutFunction} className="exit-button">
              Exit
            </button>
          </div>
        ) : (
          <Login onLogin={handleLogin} />
        )}
        {username && (
          <CreateRatingForm
            // Pass onCreateRating as a callback to handle rating creation
            onCreateRating={(newRating) => {
              setSongs(prevSongs => [...prevSongs, newRating]);
            }}
            session_username={username}
          />
        )}
        <div>
          <SongList
            songs={songs}
            username={username}
            // Pass onDeleteSong as a callback to handle song deletion
            onDeleteSong={(songId) => {
              setSongs(prevSongs => prevSongs.filter(song => song.id !== songId));
            }}

          />
        </div>
      </header>
    </div>
  );
}

export default App;