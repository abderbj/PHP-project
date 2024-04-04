// App.js
import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Register from './ComponentsRegister/Register.js';
import Login from './ComponentsLogin/Login.js';
import FrontPage from './FrontPageComponents/FrontPage.js';
import store from './store';
import { Provider } from 'react-redux';

function App() {
    return (
      <Provider store={store}>
        <Router>
            <Routes>
                <Route path="/" element={<Register />} />
                <Route path="/login" element={<Login />} />
                <Route path="/frontpage" element={<FrontPage/>} />
                <Route path="/admin" element={<h1>ADMIN DASHBOARD</h1>}/>
            </Routes>
        </Router>
        </Provider>
    );
}

export default App;