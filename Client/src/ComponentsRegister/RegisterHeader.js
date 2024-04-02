import { FaCar } from 'react-icons/fa';
import "./RegisterHeader.css";

function RegisterHeader() {
    return (
        <div className="RegisterHeader">
            <div className="underline-wrapper">
                <h1>FTHNITY</h1>
                <FaCar />
            </div>
        </div>
    );
}

export default RegisterHeader;