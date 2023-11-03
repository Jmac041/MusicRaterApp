import React, { useState } from 'react';
import axios from 'axios';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

function Login({ onLogin }) {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
  
    try {
      const response = await axios.post('http://localhost:8080/index.php/user/login', {
        username,
        password
      });
  
      if (response.data.success) {
        // Display a success notification
        toast.success('Login successful', {
          position: 'top-right', // Adjust the position as needed
          autoClose: 3000, // Notification will close after 3 seconds
        });
  
        onLogin(username); // Call the onLogin function to set the username in the parent component
      } else {
        if (response.data.error === "Incorrect username") {
          // Display an error notification
          toast.error(response.data.error, {
            position: 'top-right',
            autoClose: 3000,
          });
        } else {
          // Display a general error notification
          toast.error('Something went wrong', {
            position: 'top-right',
            autoClose: 3000,
          });
        }
      }
    } catch (err) {
      console.error("There was an error logging in:", err);
  
      // Display a general error notification
      toast.error('Incorrect Username or Password', {
        position: 'top-right',
        autoClose: 3000,
      });
    }
  };

  return (
    <div>
      <ToastContainer /> 
      <h1>Login</h1>
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="username">Username:</label>
          <input
            type="text"
            id="username"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            required
          />
        </div>
        <div>
          <label htmlFor="password">Password:</label>
          <input
            type="password"
            id="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
        </div>
        <div>
          <button type="submit">Login</button>
        </div>
        {error && <p style={{ color: 'red' }}>{error}</p>}
      </form>
    </div>
  );
}

export default Login;
