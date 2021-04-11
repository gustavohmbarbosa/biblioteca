import axios from "@/services/axios"

export default {
  async login({ commit }, payload) {
    try {
      const { data } = await axios.post("admin/login", payload);
      const { user, access_token } = data;

      commit("SET_USER", user);
      commit("SET_TOKEN", access_token);

      return Promise.resolve(data);
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async logout({ commit }) {
    try {
      const response = await axios.post("admin/logout")

      commit('SET_USER', {});
      commit('REMOVE_TOKEN');

      return Promise.resolve(response);
    } catch (error) {
      return Promise.reject(error);
    }
  }
}
