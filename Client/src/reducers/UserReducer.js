import { createSlice } from '@reduxjs/toolkit';

const initialState = {
    user : undefined
};

const UserReducer = createSlice({
    name: 'user',
    initialState,
    reducers: {
        serUser(state, action) {
            state.user = action.payload;
        }
    }
});

export const { openModal, closeModal } = UserReducer.actions;
export default UserReducer.reducer;
