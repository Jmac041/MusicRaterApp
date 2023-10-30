import React from 'react';

function Rating({ value, onChange }) {
    // Generate the stars based on the value
    const renderStars = () => {
        let stars = [];

        for (let i = 1; i <= 5; i++) {
            if (i <= value) {
                stars.push(
                    <span 
                        key={i} 
                        onClick={() => onChange(i)}
                        style={{ cursor: 'pointer' }}
                    >
                        ★
                    </span>
                );
            } else {
                stars.push(
                    <span 
                        key={i} 
                        onClick={() => onChange(i)}
                        style={{ cursor: 'pointer' }}
                    >
                        ☆
                    </span>
                );
            }
        }

        return stars;
    }

    return (
        <div>
            {renderStars()}
        </div>
    );
}

export default Rating;
