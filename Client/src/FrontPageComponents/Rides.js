import React, { useState, useEffect } from 'react'
import "../App.css";
import { useSelector } from 'react-redux'
import { Pagination } from 'antd';
import axios from 'axios';
import "./Rides.css";
import { Menu, Dropdown, Spin,Modal } from 'antd';
import { UserOutlined } from '@ant-design/icons';
const Rides = (props) => {
    const [isModalVisible, setIsModalVisible] = useState(false);
    const [selectedImage, setSelectedImage] = useState(null);

    const viewProfilePicture = (image) => {
        setSelectedImage(image);
        setIsModalVisible(true);
    };
   

    const reportUser = (id) => {
        const data = new FormData();
        data.append("action", "report");
        data.append("id", id);
        data.append("reported_id",id);
        axios.post("http://localhost/Server/api.php", data)
            .then(response => {
                if (response.status === 200) {
                    alert("User has been reported.");
                } else {
                    alert("An error occurred. Please try again later.");
                }
            })
            .catch(error => {
                console.error(error);
                alert("An error occurred. Please try again later.");
            });
    };

    const menu = (image,id) => (
        <Menu>
            <Menu.Item key="1" onClick={() => reportUser(id)}>
                Report User
            </Menu.Item>
            <Menu.Item key="2" onClick={() => viewProfilePicture(image)}>
                View Profile Picture
            </Menu.Item>
        </Menu>
    );
    const filters = useSelector(state => state.filters);
    const [offers, setOffers] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [subOffers, setSubOffers ] = useState(offers.slice(0, 9));
    useEffect(() => {
        async function fetchData() {
            const data = new FormData();
            if (filters.departure) data.append("departure", filters.from);
            if (filters.arrival) data.append("arrival", filters.to);
            if (filters.date) data.append("date", filters.date);
            if (filters.time) data.append("time", filters.time);
            if (filters.rating) data.append("rating", filters.rating);
            if (filters.currency) data.append("price", filters.currency);
            if (filters.places) data.append("having", filters.places);
            data.append("action", "getAllRides");

            try {
                const response = await axios.post("http://localhost/Server/api.php", data);
                console.log(response);
                if (response.status === 200) {
                    const responseData = response.data;
                    if (responseData === "[]null") {
                        setOffers([]);
                    } else {
                        setOffers(responseData);
                        console.log(responseData);
                    }
                }
            } catch (error) {
                console.error(error);
                alert("An error occurred. Please try again later.");
            }
        }

        // Call fetchData only once when component mounts
        fetchData();
    }, [props.refreshKey]);
    useEffect(() => {
        setSubOffers(offers.slice((currentPage - 1) * 9, currentPage * 9));
        console.log(subOffers);
    }, [currentPage, offers]);
    return (
        <div className='offers flex flex-col'>
            <table className='tab'>
                <thead>
                    <tr>
                        <th>Profile Picture</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Currency</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Rating</th>
                        <th>Places</th>
                    </tr>
                </thead>
                {subOffers.map((offer) => {
                    return (
                        <tr key={offer.id}>
                            <td>
                            <Dropdown overlay={menu(`data:image/png;base64,${offer.pfp_path}`,offer.id)} trigger={['click']}>
                                    <img src={`data:image/png;base64,${offer.pfp_path}`} alt='Profile Picture' className='pfp' />
                                </Dropdown>
                            </td>
                            <td>{offer.firstname}</td>
                            <td>{offer.departure_date}</td>
                            <td>{offer.departure_time}</td>
                            <td>{offer.price}</td>
                            <td>{offer.departure}</td>
                            <td>{offer.arrival}</td>
                            <td>{offer.rating}</td>
                            <td>{offer.places}</td>
                        </tr>
                    );
                })}
            </table>
            <Pagination defaultCurrent={1} total={50} onChange={(page) => setCurrentPage(page)} className='pag' />
            <Modal visible={isModalVisible} onCancel={() => setIsModalVisible(false)} footer={null} centered>
                <img src={selectedImage} alt="Profile" style={{ width: '100%', height: 'auto' }} />
            </Modal>
        </div>
    )
}

export default Rides;