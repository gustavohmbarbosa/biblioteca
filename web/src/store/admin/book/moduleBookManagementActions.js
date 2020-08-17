/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
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
      axios.post(`admin/books/${book.id}`, book)
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
}
