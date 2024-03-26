import { createSlice } from '@reduxjs/toolkit';

const initialState = {

};

const filterSlice = createSlice({
  name: 'filter',
  initialState,
  reducers: {
    setFilter(state, action) {
      state.action.payload.filter = action.payload.value;
    }
  }
});

export const { setFilter } = filterSlice.actions;
export default filterSlice.reducer;
