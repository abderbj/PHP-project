import {
  configureStore
} from '@reduxjs/toolkit';
import filtersReducer from './reducers/filtersReducer';
const store = configureStore({
  reducer: {
    filters: filtersReducer
  }
});

export default store;