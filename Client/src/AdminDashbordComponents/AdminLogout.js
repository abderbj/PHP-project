import React from "react";
import "./NavbarAdminDashbord.css";

function AdminLogout() {
  const handleLogout = () => {
    localStorage.setItem("userId", null);

    window.location.href = "/login";
  };
  return (
    <div  className="logout-button" onClick={handleLogout}>
      Logout
    </div>
  );
}
export default AdminLogout;
