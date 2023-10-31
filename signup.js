// SignUp.js
import React, { useState } from 'react';
import axios from 'axios';

function SignUp() {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState(null);

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post('http://localhost/MusicRaterApp//SignUp.php', {
                username,
                password,
            });

            if (response.data.success) {
                console.log("User registered successfully");
                // Handle success - for example, redirecting to login or showing a success message
            } else {
                setError(response.data.error);
            }
        } catch (error) {
            console.error("Error registering user:", error);
            setError("An error occurred. Please try again.");
        }
    };

    return (
        <div>
            <h2>Sign Up</h2>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Username:</label>
                    <input
                        type="text"
                        value={username}
                        onChange={(e) => setUsername(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label>Password:</label>
                    <input
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <button type="submit">Sign Up</button>
                </div>
            </form>
            {error && <p style={{ color: 'red' }}>{error}</p>}
        </div>
    );
}

export default SignUp;
