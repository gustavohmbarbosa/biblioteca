/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------

==========================================================================================*/

import axios from "@/axios.js"

export default {
  index({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("admin/books")
        .then((response) => {
          commit('SET_BOOKS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, book) {
    return new Promise((resolve, reject) => {
      axios.post("/admin/books", book)
        .then((response) => {
          commit('ADD_BOOK', Object.assign(book, {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => 
        { 
          reject(error) 
        })
    })
  },
  destroy({ commit }, bookId) {
    return new Promise((resolve, reject) => {
      axios.delete(`admin/books/${bookId}`)
        .then((response) => {
          commit('REMOVE_RECORD', bookId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
}
