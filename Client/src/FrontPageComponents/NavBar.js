import React from 'react';
import './NavBar.css';

const NavBar = () => {
    return (
        <div style={{ display: 'flex', alignItems: 'center', marginLeft: '200px' }} className='nav-bar'>
            <img className='mt-1' src="/src/logo.svg" alt="logo" style={{ width: '50px', height: '50px', marginRight: '10px' }} />
            <div style={{ display: 'flex', marginRight: '10px' }}>
                <div style={{ marginRight: '10px' }}>
                    <label htmlFor="fromCity">From</label>
                    <input type="text" id="fromCity" name="fromCity" placeholder="City" className='mt-1' />
                </div>
                <div>
                    <label htmlFor="toCity">To</label>
                    <input type="text" id="toCity" name="toCity" placeholder="City" className='mt-1' />
                </div>
            </div>
            <div>
                <label htmlFor="date">On</label>
                <input type='date' id='date' name='date' className='mt-1' />
            </div>
        </div>
    );
}

export default NavBar;
