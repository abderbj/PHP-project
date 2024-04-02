import { Provider } from 'react-redux';
import Offers from './Offers';
import SideBar from './SideBar';
import NavBar from "./NavBar";
function FrontPage() {
    return (
        <div>
            <SideBar />
            <NavBar />
            <Offers />
        </div>
    );
}

export default FrontPage;
