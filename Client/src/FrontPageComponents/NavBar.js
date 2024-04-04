import React from 'react';
import './NavBar.css';

const NavBar = () => {
    return (
        <div style={{ display: 'flex', alignItems: 'center', marginLeft: '200px' }} className='nav-bar'>
            <img className='mt-1 navbar-img' src="/src/logo.svg" alt="logo" style={{ width: '50px', height: '50px', marginRight: '10px' }} />
            <div className="navbar-div" style={{ display: 'flex', marginRight: '10px' }}>
                <div className="navbar-div"  style={{ marginRight: '10px' }}>
                    <label className='nav-bar-label'htmlFor="fromCity">From</label>
                    <input  type="text" id="fromCity" name="fromCity" placeholder="City" className="mt-1 navbar-input" />
                </div>
                <div className="navbar-div">
                    <label className='nav-bar-label'htmlFor="toCity">To</label>
                    <input type="text" id="toCity" name="toCity" placeholder="City" className="mt-1 navbar-input" />
                </div>
            </div>
            <div className="navbar-div">
                <label className="nav-bar-label" >On</label>
                <input  type='date' id='date' name='date' className="mt-1 navbar-input" />
            </div>
        </div>
    );
}

export default NavBar;
