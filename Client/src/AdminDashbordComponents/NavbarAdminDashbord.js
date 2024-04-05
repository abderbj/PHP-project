import React from 'react';
import RegisterHeader from '../ComponentsRegister/RegisterHeader';
import './NavbarAdminDashbord.css';
const NavBarAdminDashbord = () => {
    return (
        <div className='nav-bar-admin flex '>
            <RegisterHeader className='mt-1 navbar-img-admin' />
            <div className="navbar-div-admin">
                <div className="navbar-div-admin" >
                    <label className='nav-bar-label-admin mt-2' htmlFor="user">User</label>
                    <input type="text" id="username" name="username" placeholder="username" className="mt-1 navbar-input-admin" />
                </div>
            </div>
        </div>
    );
}

export default NavBarAdminDashbord;
