import React, { useState } from 'react';
import './CreateNewRide.css';
import img from './cross.png';
import { closeModal } from '../reducers/showModalReducer';
import { useDispatch } from 'react-redux';
const CreateNewRide = () => {
    const dispatch = useDispatch();
    const [fromCity, setFromCity] = useState('');
    const [toCity, setToCity] = useState('');
    const [date, setDate] = useState('');
    const [price, setPrice] = useState('');
    const [time, setTime] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Submitted:', { fromCity, toCity, date });
    };
    const handleCloseModal = () => {
        dispatch(closeModal());
    }
    return (
        <div className="modal-overlay">
            <div className="new-ride-form">
                <div className="row">
                <h2>Create New Ride</h2>
                    <img onClick={() => handleCloseModal()}  src={img} alt="cross" className="cross" />
                </div>
                <form onSubmit={handleSubmit}>
                    <div className="h_line"></div>
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
                        <div className="column-right">
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
                        <div className="column-right">
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
                            <textarea
                                id="description"
                                placeholder="description"
                            />
                    </div>
                    <div className="h_line"></div>
                    <div className="row">
                        <label htmlFor="seats">Seats</label>
                        <input
                            type="number"
                            id="seats"
                            className="seats"
                        />
                    <button type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default CreateNewRide;