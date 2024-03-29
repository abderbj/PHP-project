import {AiOutlineEye, AiOutlineEyeInvisible} from "react-icons/ai";
import React, {useState} from "react";
import './LoginCard.css';
import axios from 'axios';
function LoginCard(){
    const [showPassword, setShowPassword] = useState(false);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const togglePasswordVisibility = () => {
        setShowPassword(!showPassword);
    };

    const handleSubmit = async (event) => {
        event.preventDefault();

        const data = {
            email,
            password
        };

        try {
            console.log(data);
             const response = await axios.post('https://your-api-url.com/login.php', data);
             console.log(response.data);
        } catch (error) {
            console.error(error);
        }
    };
    return (
        <div className="LoginCard">
            <div className="card">
                <div className="card-body">
                    <h5 className="card-title">Embark on an expedition </h5>
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label htmlFor="email" className="form-label">Email</label>
                            <input type="email" className="form-control" id="email" placeholder="Enter Email"
                                   value={email} onChange={(e) => setEmail(e.target.value)}/>
                        </div>
                        <div className="form-group">
                            <label htmlFor="password" className="form-label">Password</label>
                            <div className="password-container">
                                <input type={showPassword ? "text" : "password"} className="form-control" id="password"
                                       placeholder="Password" value={password}
                                       onChange={(e) => setPassword(e.target.value)}/>
                                <div className="password-icon" onClick={togglePasswordVisibility}>
                                    {showPassword ? <AiOutlineEyeInvisible/> : <AiOutlineEye/>}
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="LoginButton" className="btn btn-primary">Login</button>
                        <p className="login-link">Don't have an account ? <a href="/">Register here</a></p>
                    </form>
                </div>
            </div>
        </div>
    );
}
export default LoginCard;