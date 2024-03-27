import logo from './logo.svg';
import './App.css';
import { Provider } from 'react-redux';
import store from './store';
import Offers from './components/Offers';
import SideBar from './components/SideBar';
import NavBar from "./components/NavBar";
function App() {
  return (
    <Provider store={store}>
      <NavBar />
    </Provider>
  );
}

export default App;
