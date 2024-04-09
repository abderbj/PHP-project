import React, { useState, useEffect } from 'react'
import { Pagination } from 'antd';
import './Users.css';
import axios from 'axios';
import { RiDeleteBin5Line } from "react-icons/ri";

function Users() {
    const [users, setUsers] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [subOffers, setSubOffers] = useState(users.slice(0, 9));
    const handleDeleteUser = (u) => {
        const newUsers = users.filter(user => user.Phone !== u.Phone);
        console.log(u);
        setUsers(newUsers);
    }

    useEffect(() => {
        // Function to fetch data when component moun   ts
        async function fetchData() {
            const data = new FormData();
            data.append("action", "getAllUsers");
            try {
                const response = await axios.post("http://localhost/Server/api.php", data);
                console.log(response);
                if (response.status === 200) {
                    console.log("New ride registered successfully");
                    const responseData = response.data;
                    if (responseData === "[]null") {
                        setUsers([]);
                    } else {
                        console.log(responseData);
                        setUsers(responseData);
                    }
                }
            } catch (error) {
                console.error(error);
                alert("An error occurred. Please try again later.");
            }
        }

        fetchData();
    }, []);
    
    useEffect(() => {
        setSubOffers(users.slice((currentPage - 1) * 9, currentPage * 9));
    }, [currentPage, users]);
    return (
        <div className='users flex flex-col'>
            <table className='tab-admin '>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Phone</th>
                        <th>Rides Created</th>
                        <th>Rides Joined</th>
                        <th></th>
                    </tr>
                </thead>
                {subOffers.map((user) => {
                    return (
                        <tr key={user.id}>
                            <td>{user.firstname} {user.lastname}</td>
                            <td>{user.rating}</td>
                            <td>{user.phonenumber}</td>
                            <td>{user.RidesCreated}</td>
                            <td>{user.RidesJoined}</td>
                            <td onClick={() => handleDeleteUser(user)}><RiDeleteBin5Line /></td>
                        </tr>
                    );
                })}
            </table>
            <Pagination defaultCurrent={1} total={50} onChange={(page) => setCurrentPage(page)} className='pag-admin' />
        </div>
    )
}

export default Users
