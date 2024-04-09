import {
  configureStore
} from '@reduxjs/toolkit';
import filtersReducer from './reducers/filtersReducer';
import showModalReducer from './reducers/showModalReducer';
import UserReducer from './reducers/UserReducer';
const store = configureStore({
  reducer: {
    filters: filtersReducer,
    showModal: showModalReducer,
    UserReducer : UserReducer,
  }
});

export default store;