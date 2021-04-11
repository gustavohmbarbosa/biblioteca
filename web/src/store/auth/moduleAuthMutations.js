export default {
  SET_USER(state, user) {
    state.user = user;
  },
  SET_TOKEN(state, token) {
    localStorage.setItem('token', token);
  },
  REMOVE_TOKEN() {
    localStorage.removeItem('token');
  },
};
