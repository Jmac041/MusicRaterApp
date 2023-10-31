import axios from 'axios';

export const deleteSong = async (id) => {
    try {
        await axios.delete(`http://localhost/MusicRaterApp/delete.php?id=${songId}`);
    } catch (error) {
        console.error("Error deleting song:", error);
    }
};
