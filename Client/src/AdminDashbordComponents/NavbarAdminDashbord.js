import React, { useState } from "react";
import RegisterHeader from "../ComponentsRegister/RegisterHeader";

import "./NavbarAdminDashbord.css";
import Logout from "../FrontPageComponents/Logout";

const NavBarAdminDashbord = () => {
  return (
    <div className="nav-bar-admin flex ">
      <RegisterHeader className="mt-1 navbar-img-admin" />
        <label className="nav-bar-label-admin mt-2">User</label>
        <input
          type="text"
          name="username"
          className="mt-1 navbar-input-admin"
        />
      <Logout />
    </div>
  );
};
export default NavBarAdminDashbord;
