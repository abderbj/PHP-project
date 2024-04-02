
// App.js
import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Register from './ComponentsRegister/Register.js';
import Login from './ComponentsLogin/Login.js';
import FrontPage from './FrontPageComponents/FrontPage.js';
import { Provider } from 'react-redux';
import { Store } from '@reduxjs/toolkit'; 
import store from './store';
function App() {
  return (
    <Provider store={store}>
    <Router>
      <Routes>
        <Route path="/" element={<Register />} />
        <Route path="/login" element={<Login />} />
          <Route path="/frontpage" element={<FrontPage />} />
      </Routes>
    </Router>
    </Provider>
  );
}

export default App;