import axios from "@/axios.js"

export default {
  index({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("admin/authors")
        .then((response) => {
          commit('SET_AUTHORS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, author) {
    return new Promise((resolve, reject) => {
      axios.post("/admin/authors", author)
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
          reject(error) 
        })
    })
  },
}
