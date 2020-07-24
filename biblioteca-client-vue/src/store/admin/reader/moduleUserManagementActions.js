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
  fetchReaders({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("/api/reader-management/readers")
        .then((response) => {
          commit('SET_READERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchReader(context, readerId) {
    return new Promise((resolve, reject) => {
      axios.get(`/api/reader-management/readers/${readerId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  removeRecord({ commit }, readerId) {
    return new Promise((resolve, reject) => {
      axios.delete(`/api/reader-management/readers/${readerId}`)
        .then((response) => {
          commit('REMOVE_RECORD', readerId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
