import {
  configureStore
} from '@reduxjs/toolkit';
import filtersReducer from './reducers/filtersReducer';
import showModalReducer from './reducers/showModalReducer';
const store = configureStore({
  reducer: {
    filters: filtersReducer,
    showModal: showModalReducer,
  }
});

export default store;