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


  const deleteSong = (songId) => {
    axios.delete(`http://localhost:8080/index.php/rating/delete?id=${songId}`)
      .then(response => {
        setSongs(prevSongs => prevSongs.filter(song => song.id !== songId));
      })
      .catch(error => {
        console.error("Error deleting song:", error);
      });
  };

  const createRating = (songData) => {
    axios.post('http://localhost:8080/index.php/rating/create', songData)
      .then(response => {
        // Handle success
        setSongs(prevSongs => [...prevSongs, response.data]); // Create a new array
      })
      .catch(error => {
        // Handle errors
        console.error("Error creating rating:", error);
      });
  };

  return (
    <div className="App">
      <header className="App-header">
        <h1>FaveTune: Music Rater App</h1>
        {username ? (
          <div className="user-info">
            <span>Logged in as: {username}</span>
            <button onClick={logoutFunction} className="exit-button">Exit</button>
          </div>
        ) : (
          <Login onLogin={handleLogin} />
        )}
        {username && (
          <CreateRatingForm onCreateRating={createRating} session_username={username} />
        )}
        <div>
          <SongList songs={songs} username={username} onDeleteSong={deleteSong} />
        </div>
      </header>
    </div>
  );
}

export default App;