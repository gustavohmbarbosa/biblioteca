import axios from "@/services/axios"

const routePrefix = "/admin/authors";

export default {
  index({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get(`${routePrefix}`)
        .then((response) => {
          commit('SET_AUTHORS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, author) {
    return new Promise((resolve, reject) => {
      axios.post(`${routePrefix}`, author)
        .then((response) => {
          try { //Case the author be stored with image.
            commit('ADD_AUTHOR', Object.assign(author, {id: response.data.id, name: author.get('name')}))
          } catch (error) {
            commit('ADD_AUTHOR', Object.assign(author, {id: response.data.id}))
          }
          resolve(response)
        })
        .catch((error) =>
        {
          reject(error);
        })
    })
  },
  show(context, authorId) {
    return new Promise((resolve, reject) => {
      axios.get(`${routePrefix}/${authorId}`)
        .then((response) => {
          resolve(response);
        })
        .catch((error) => { reject(error) });
    })
  },
  update({ commit }, author) {
    return new Promise((resolve, reject) => {
      axios.put(`${routePrefix}/${author.get('id')}`, author)
        .then((response) => {
          commit('UPDATE_AUTHOR', response.data.data);
          resolve(response);
        })
        .catch((error) => { reject(error) });
    })
  },
  destroy({ commit }, authorId) {
    return new Promise((resolve, reject) => {
      axios.delete(`${routePrefix}/${authorId}`)
        .then((response) => {
          commit('REMOVE_AUTHOR', authorId);
          resolve(response);
        })
        .catch((error) => { reject(error) });
    })
  }
}
