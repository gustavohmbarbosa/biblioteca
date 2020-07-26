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
  // addItem({ commit }, item) {
  //   return new Promise((resolve, reject) => {
  //     axios.post("/api/data-list/products/", {item: item})
  //       .then((response) => {
  //         commit('ADD_ITEM', Object.assign(item, {id: response.data.id}))
  //         resolve(response)
  //       })
  //       .catch((error) => { reject(error) })
  //   })
  // },
  fetchBooks({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/book-management/books")
        .then((response) => {
          commit('SET_BOOKS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchBook(context, bookId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/book-management/books/${bookId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeRecord({ commit }, bookId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/book-management/books/${bookId}`)
        .then((response) => {
          commit('REMOVE_RECORD', bookId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
