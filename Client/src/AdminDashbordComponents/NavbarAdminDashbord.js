import React, { useState } from "react";
import RegisterHeader from "../ComponentsRegister/RegisterHeader";

import "./NavbarAdminDashbord.css";
import AdminLogout from "./AdminLogout";

const NavBarAdminDashbord = () => {
  return (
    <div className="nav-bar-admin flex ">
      <RegisterHeader className="mt-1 navbar-img-admin" />

      <div className="navbar-div-admin">
        <label className="nav-bar-label-admin mt-2">User</label>
        <input
          type="text"
          name="username"
          className="mt-1 navbar-input-admin"
        />
        <AdminLogout />
      </div>
    </div>
  );
};
export default NavBarAdminDashbord;
