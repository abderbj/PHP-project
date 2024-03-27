import React from 'react';

const NavBar = () => {
    return (
        <div style={{ display: 'flex', alignItems: 'center' }}>
            <img src="/public/logo.png" alt="logo" style={{ width: '50px', height: '50px' }} />
            <div>
                <label htmlFor="fromCity">From</label>
                <input type="text" id="fromCity" name="fromCity" placeholder="City"/>
            </div>
            <div>
                <label htmlFor="toCity">To</label>
                <input type="text" id="toCity" name="toCity" placeholder="City"/>
            </div>
            <div>
                <label htmlFor="date">On</label>
                <input type='date' id='date' name='date'/>
            </div>
        </div>
    );
}

export default NavBar;
