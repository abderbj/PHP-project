import React, { useEffect, useState } from 'react'
import { CiStar } from "react-icons/ci";
import { FaStar } from "react-icons/fa6";
import Slider from '@mui/material/Slider';
import "../App.css";
function SideBar() {
    const [min, setMin] = useState(0);
    const [max, setMax] = useState(400);
    const [places, setPlaces] = useState(1);
    const [review, setReview] = useState(4);
    useEffect(() =>{

    },[min,max,places,review]);
  return (
    <div className='flex flex-col gap-4 side-bar'>
      <button className='add-btn'>+ Start your own car pooling</button>
        <div className='flex flex-col mr-6 gap-1'>
        <p className='pricing'>Pricing</p>
        <div className='flex gap-4'>
          <div className='flex flex-col gap-1'>
                <p className='min'>Min</p>
                <input type="text" onChange={(e) => setMin(e.target.value)}
              style={{ backgroundColor:"#F3F4F6", width:"103px" , height:"35px"}}
                />
            </div>
          <div className='flex flex-col gap-1'>
            <p className='min'>Max</p>
                <input type="text" onChange={(e) => setMax(e.target.value)}
              style={{ backgroundColor: "#F3F4F6", width: "103px", height: "35px" }}
                />
            </div>
        
        </div>
        </div>
      <div className='flex flex-col gap-1'>
        <h2 className='places'>Places Available</h2>
        <Slider
          value = {places}
          min={1}
          max={7}
          step={1}
          marks={true}
          valueLabelDisplay="auto"
          className="custom-slider slid" 
          style={{ width: '228px', height: '6px', maxWidth: '100%' }}
          onChange={(e, newvalue) => setPlaces(newvalue)}
        />
    </div>
    <div className='flex flex-col gap-1'>
    <h2 className='mr-12 mb-1 review'>Review</h2>
        <div className='flex gap-1 stars'>
    <input type="radio" name="review" className='inp'/>
    <label><div className='flex'><FaStar /> <FaStar /> <FaStar />  <FaStar />  <FaStar />  </div></label>
    </div>
        <div className='flex gap-1 stars'>
    <input className='inp'type="radio" name="review"/>
    <label><div  className='flex' ><FaStar /> <FaStar /> <FaStar />  <FaStar /> <CiStar /> </div></label>
    </div>
        <div className='flex gap-1 stars'>
          <input type="radio" name="review" className='inp' />
    <label><div className='flex'><FaStar /> <FaStar /> <FaStar /> <CiStar /> <CiStar /> </div></label>
    </div>
        <div className='flex gap-1 stars'>
          <input type="radio" name="review" className='inp' />
    <label><div  className='flex'><FaStar /> <FaStar /> <CiStar /> <CiStar /> <CiStar /> </div></label>
    </div>
        <div className='flex gap-1 stars' >
          <input type="radio" name="review" className='inp' />
    <label><div  className='flex'><FaStar />  <CiStar /> <CiStar /> <CiStar /> <CiStar /> </div></label>
    </div>
      </div>
      
    </div>

  )
}

export default SideBar
