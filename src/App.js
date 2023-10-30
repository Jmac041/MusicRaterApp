import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './App.css';
import SongList from './components/SongList.js';
import CreateRatingForm from './components/CreateRatingForm.js';

function App() {
  const [songs, setSongs] = useState([]);

  useEffect(() => {
    // Assuming 'read.php' retrieves the songs list
    axios.get('http://localhost/MusicRaterApp/read.php')
      .then(response => {
        setSongs(response.data);
      })
      .catch(error => {
        console.error("Error fetching songs:", error);
      });
  }, []);

  // CRUD operations methods here...

  return (
    <div className="App">
      <header className="App-header">
        <h1>Song Rater</h1>
        <CreateRatingForm /*props or methods for creating a new song/rating...*/ />
        <div>
            <h2>Songs List:</h2>
            <SongList songs={songs} /*other props or methods for CRUD...*/ />
        </div>
      </header>
    </div>
  );
}

export default App;

