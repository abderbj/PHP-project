import React, { useState, useEffect } from 'react'
import { useSelector } from 'react-redux'
import { Pagination } from 'antd';
import './Users.css'
function Offers() {
    const [users, setUsers] = useState([
        {
            "Name": "John Doe",
            "Joinedon": "2023-05-10",
            "Rating": 4.7,
            "Phone": "+1234567890",
            "RidesCreated": 15,
            "RidesJoined": 20
        },
        {
            "Name": "Alice Smith",
            "Joinedon": "2022-12-15",
            "Rating": 4.9,
            "Phone": "+1987654321",
            "RidesCreated": 30,
            "RidesJoined": 25
        },
        {
            "Name": "David Johnson",
            "Joinedon": "2023-02-28",
            "Rating": 4.5,
            "Phone": "+1122334455",
            "RidesCreated": 10,
            "RidesJoined": 35
        },
        {
            "Name": "Emily Brown",
            "Joinedon": "2024-01-20",
            "Rating": 4.8,
            "Phone": "+1555666777",
            "RidesCreated": 20,
            "RidesJoined": 30
        },
        {
            "Name": "Michael Wilson",
            "Joinedon": "2023-08-05",
            "Rating": 4.6,
            "Phone": "+1443322110",
            "RidesCreated": 25,
            "RidesJoined": 15
        },
        {
            "Name": "Sarah Martinez",
            "Joinedon": "2022-10-30",
            "Rating": 4.7,
            "Phone": "+1777888999",
            "RidesCreated": 12,
            "RidesJoined": 18
        },
        {
            "Name": "Robert Taylor",
            "Joinedon": "2023-11-17",
            "Rating": 4.9,
            "Phone": "+1666999888",
            "RidesCreated": 18,
            "RidesJoined": 22
        },
        {
            "Name": "Jennifer Anderson",
            "Joinedon": "2024-02-10",
            "Rating": 4.5,
            "Phone": "+1888777666",
            "RidesCreated": 8,
            "RidesJoined": 28
        },
        {
            "Name": "Christopher Thomas",
            "Joinedon": "2022-09-25",
            "Rating": 4.8,
            "Phone": "+1223444555",
            "RidesCreated": 22,
            "RidesJoined": 33
        },
        {
            "Name": "Linda Garcia",
            "Joinedon": "2023-04-12",
            "Rating": 4.7,
            "Phone": "+1999888777",
            "RidesCreated": 16,
            "RidesJoined": 21
        },
        {
            "Name": "William Rodriguez",
            "Joinedon": "2022-11-08",
            "Rating": 4.6,
            "Phone": "+1666111222",
            "RidesCreated": 28,
            "RidesJoined": 17
        }
    ]
);
    const [currentPage, setCurrentPage] = useState(1);
    const [subOffers, setSubOffers] = useState(users.slice(0, 9));
    useEffect(() => {
        /*axios.get('/offers', {params: filters})
            .then(response => {
                setOffers(response.data);
            })
            .catch(error => {
                console.error('Error fetching offers:', error);
            });*/
        setSubOffers(users.slice((currentPage - 1) * 9, currentPage * 9));
        console.log(users);
        console.log(subOffers);
    }, [currentPage, users]);

    return (
        <div className='users flex flex-col'>
            <table className='tab-admin '>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Joined on </th>
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
                            <td>{user.Name}</td>
                            <td>{user.Joinedon}</td>
                            <td>{user.Rating}</td>
                            <td>{user.Phone}</td>
                            <td>{user.RidesCreated}</td>
                            <td>{user.RidesJoined}</td>
                            <td></td>
                        </tr>
                    );
                })}
            </table>
            <Pagination defaultCurrent={1} total={50} onChange={(page) => setCurrentPage(page)} className='pag-admin' />
        </div>
    )
}

export default Offers
