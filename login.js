import React, { useState } from 'react';
import axios from 'axios';

function Login() {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post('http://localhost/MusicRaterApp//login.php', {
                username,
                password
            });

            if (response.data.success) {
                // Handle successful login (e.g. navigate to dashboard, store user session locally)
                console.log("Logged in successfully");
            } else {
                setError(response.data.error);
            }
        } catch (err) {
            console.error("There was an error logging in:", err);
        }
    };

    return (
        <div>
            <h1>Welcome to FaveTune</h1>
            <h2>Login</h2>
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
                        minLength="10"
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
