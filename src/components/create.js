import axios from 'axios';

const apiUrl = "/Applications/XAMPP/xamppfiles/htdocs/MusicRaterApp/Model/Database.php";

function createSong(data) {
    return axios.post(apiUrl, {
        ...data,
        action: 'create'
    })
    .then(res => res.data)
    .catch(err => console.error(err));
}

export { createSong };
