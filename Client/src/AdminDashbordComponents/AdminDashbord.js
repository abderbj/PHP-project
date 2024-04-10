import React from "react";
import NavbarAdminDashbord from "./NavbarAdminDashbord";
import SideBar from "./SideBarAdmin";
import Users from "./Users";
function AdminDashbord() {
  return (
    <div>
      <NavbarAdminDashbord />
      <SideBar />
      <Users />
      
    </div>
  );
}

export default AdminDashbord;
