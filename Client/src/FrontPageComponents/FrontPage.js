import Offers from './Offers';
import SideBar from './SideBar';
import NavBar from './NavBar';
import CreateNewRide from './CreateNewRide';
import { useSelector } from 'react-redux';
function FrontPage() {
    const show = useSelector(state => state.showModal.show);
    return (
        <div>
            <SideBar />
            <NavBar />
            <Offers />
            {show && <CreateNewRide />}
        </div>
    );
}

export default FrontPage;
