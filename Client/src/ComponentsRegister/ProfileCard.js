import React, { useState, useRef } from 'react';
import icon from './profileicon.PNG';

function ProfileCard() {
    const [selectedImage, setSelectedImage] = useState(icon);
    const fileInputRef = useRef();
    const imageRef = useRef();

    const handleImageChange = (event) => {
        if (event.target.files && event.target.files[0]) {
            let reader = new FileReader();
            reader.onload = (e) => {
                let img = new Image();
                img.onload = () => {
                    let canvas = document.createElement('canvas');
                    let ctx = canvas.getContext('2d');
                    canvas.width = imageRef.current.width;
                    canvas.height = imageRef.current.height;
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    setSelectedImage(canvas.toDataURL());
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    };

    const handleImageClick = () => {
        fileInputRef.current.click();
    };

    return (
        <div>
            <h1>Profile Picture</h1>
            <img ref={imageRef} src={selectedImage} alt="Avatar" className="avatar" onClick={handleImageClick} />
            <input type="file" onChange={handleImageChange} ref={fileInputRef} style={{display: 'none'}} />
        </div>
    );
}

export default ProfileCard;