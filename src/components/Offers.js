import React, { useState ,useEffect} from 'react'
import {useSelector} from 'react-redux'
import { Pagination } from 'antd';
function Offers() {
    const filters = useSelector(state => state.filters);
    const [offers, setOffers] = useState( [ {
    "id": 1,
    "name": "Offer 1",
    "date": "2024-03-25",
    "time": "10:00 AM",
    "currency": "USD",
    "from": "New York",
    "to": "Los Angeles",
    "rating": 4.5,
    "places": 5
  },
  {
    "id": 2,
    "name": "Offer 2",
    "date": "2024-03-26",
    "time": "12:00 PM",
    "currency": "EUR",
    "from": "London",
    "to": "Paris",
    "rating": 4.2,
    "places": 3
  },
  {
    "id": 3,
    "name": "Offer 3",
    "date": "2024-03-27",
    "time": "3:00 PM",
    "currency": "JPY",
    "from": "Tokyo",
    "to": "Osaka",
    "rating": 4.7,
    "places": 7
  }]); 
  const [currentPage, setCurrentPage] = useState(1);
    const [subOffers, setSubOffers] = useState(offers.slice(0, 9));
    useEffect(() => {
    /*axios.get('/offers', {params: filters})
        .then(response => {
            setOffers(response.data);
        })
        .catch(error => {
            console.error('Error fetching offers:', error);
        });*/
            setSubOffers(offers.slice((currentPage-1)*9,currentPage*9));
            console.log(offers);
            console.log(currentPage);
            console.log(subOffers);
    }, [currentPage, offers]); 

    return (
    <>
    <table>
        <thead>
        <tr>
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
                            <td>{offer.name}</td>
                            <td>{offer.date}</td>
                            <td>{offer.time}</td>
                            <td>{offer.currency}</td>
                            <td>{offer.from}</td>
                            <td>{offer.to}</td>
                            <td>{offer.rating}</td>
                            <td>{offer.places}</td>
                        </tr>
            );
        })}
    </table>
    <Pagination defaultCurrent={1} total={50} onChange={(page)=> setCurrentPage(page)}/>
    </>
    )
}

export default Offers
