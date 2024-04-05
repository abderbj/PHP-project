import React, { useEffect, useState } from 'react'
import { CiStar } from "react-icons/ci";
import { FaStar } from "react-icons/fa6";
import { useDispatch } from 'react-redux';import "./SideBarAdmin.css";
function SideBar() {
    const dispatch = useDispatch();
    const [review, setReview] = useState(4);
    useEffect(() => {

    }, [review]);
    return (
        <div className='flex flex-col gap-4 ml-4 side-bar-admin'>
            <div className='flex gap-4 mb-2'>
                <div className='flex  gap-2'>
                    <p className='text-admin'>Total Users</p>
                    <p className="text-admin">5000</p>
                </div>
            </div>
            <div className='flex  gap-2'>
                <p className='text-admin'>Total Rides</p>
                <p className="text-admin">5000</p>
            </div>
            <div className='flex flex-col ml-1'>
                <h2 className='mr-12 mt-2 mb-2 review-admin'>Review</h2>
                <div className='flex gap-1 '>
                    <input type="radio" name="review" className='inp-admin' />
                    <label><div className='flex star-admin'><FaStar /> <FaStar /> <FaStar />  <FaStar />  <FaStar />  </div></label>
                </div>
                <div className='flex gap-1 '>
                    <input className='inp-admin' type="radio" name="review" />
                    <label><div className='flex star-admin' ><FaStar /> <FaStar /> <FaStar />  <FaStar /> <CiStar /> </div></label>
                </div>
                <div className='flex gap-1'>
                    <input type="radio" name="review" className='inp-admin' />
                    <label><div className='flex star-admin'><FaStar /> <FaStar /> <FaStar /> <CiStar /> <CiStar /> </div></label>
                </div>
                <div className='flex gap-1'>
                    <input type="radio" name="review" className='inp-admin' />
                    <label><div className='flex star-admin'><FaStar /> <FaStar /> <CiStar /> <CiStar /> <CiStar /> </div></label>
                </div>
                <div className='flex gap-1' >
                    <input type="radio" name="review" className='inp-admin' />
                    <label><div className='flex star-admin'><FaStar />  <CiStar /> <CiStar /> <CiStar /> <CiStar /> </div></label>
                </div>
            </div>
        </div>

    )
}

export default SideBar
