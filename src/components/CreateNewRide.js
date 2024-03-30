import React, { useState } from 'react';
import './CreateNewRide.css';
const CreateNewRide = () => {
    const [fromCity, setFromCity] = useState('');
    const [toCity, setToCity] = useState('');
    const [date, setDate] = useState('');
    const [price, setPrice] = useState('');
    const [time, setTime] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Submitted:', { fromCity, toCity, date });
    };

    return (
        <div className="new-ride-form">
            <h2>Create New Ride</h2>
            <form onSubmit={handleSubmit}>
                <div className="row">
                    <div className="column">
                        <label htmlFor="fromCity">From</label>
                            <input
                                type="text"
                                id="fromCity"
                                value={fromCity}
                                onChange={(e) => setFromCity(e.target.value)}
                                placeholder="Enter starting city"
                            />
                    </div>
                    <div className="column">
                        <label htmlFor="toCity">To</label>
                        <input
                            type="text"
                            id="toCity"
                            value={toCity}
                            onChange={(e) => setToCity(e.target.value)}
                            placeholder="Enter destination city"
                        />
                    </div>
                </div>
                <div className="row">
                    <div className="column">
                        <label htmlFor="date">On</label>
                        <input
                            type="date"
                            id="date"
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                        />
                    </div>
                    <div className="column">
                        <label htmlFor="time">At</label>
                        <input
                            type="time"
                            id="time"
                            value={time}
                            onChange={(e) => setTime(e.target.value)}
                        />
                    </div>
                    <div className="column">
                        <label htmlFor="price">Price</label>
                        <input
                            type="number"
                            id="price"
                            value={price}
                            onChange={(e) => setPrice(e.target.value)}
                        />
                    </div>
                </div>
                <div className="row">
                    <div className="column-image">
                        <img  src="https://w7.pngwing.com/pngs/858/581/png-transparent-profile-icon-user-computer-icons-system-chinese-wind-title-column-miscellaneous-service-logo-thumbnail.png" alt="ride" />
                        <label htmlFor="phone">34512322</label>
                    </div>
                    <div className="column">
                        <label htmlFor="description">Description</label>
                        <textarea
                            id="description"
                            placeholder="description"
                        />
                    </div>
                </div>
                <button type="submit">Create</button>
            </form>
        </div>
    );
};

export default CreateNewRide;
