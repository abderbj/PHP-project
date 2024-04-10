import React from 'react';
import './NavBar.css';
import RegisterHeader from '../ComponentsRegister/RegisterHeader';
import Logout from './Logout';
const NavBar = () => {
    return (
        <div  className='nav-bar'>
            <RegisterHeader className='mt-1 navbar-img' />
            <div className="navbar-div">
                <div className="navbar-div" >
                    <label className='nav-bar-label mt-1'htmlFor="fromCity">From</label>
                    <input  type="text" id="fromCity" name="fromCity" placeholder="City" className="mt-1 navbar-input" />
                </div>
                <div className="navbar-div">
                    <label className='nav-bar-label mt-1'htmlFor="toCity">To</label>
                    <input type="text" id="toCity" name="toCity" placeholder="City" className="mt-1 navbar-input" />
                </div>
            </div>
            <div className="navbar-div">
                <label className="nav-bar-label mt-2" >On</label>
                <input  type='date' id='date' name='date' className="mt-1 navbar-input" />
            </div>
            <Logout />
        </div>
    );
}

export default NavBar;
