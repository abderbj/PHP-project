import { Provider } from 'react-redux';
import store from './store';
import Offers from './components/Offers';
import SideBar from './components/SideBar';
import NavBar from "./components/NavBar";
function FrontPage() {
    return (
        <Provider store={store}>
            <SideBar />
            <NavBar />
            <Offers />
        </Provider>
    );
}

export default FrontPage;
