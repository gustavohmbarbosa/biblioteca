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
      axios.get("admin/readers")
        .then((response) => {
          commit('SET_READERS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, item) {
    return new Promise((resolve, reject) => {
      axios.post("admin/readers", {item: item})
        .then((response) => {
          commit('ADD_ITEM', Object.assign(item, {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  update(context, readerId) {
    return new Promise((resolve, reject) => {
      axios.put(`admin/readers/${readerId}`)
      .then((response) => {
        resolve(response)
      })
      .catch((error) => { reject(error) })
    })
  },
  show(context, readerId) {
    return new Promise((resolve, reject) => {
      axios.get(`admin/readers/${readerId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  destroy({ commit }, readerId) {
    return new Promise((resolve, reject) => {
      axios.delete(`admin/readers/${readerId}`)
        .then((response) => {
          commit('REMOVE_RECORD', readerId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  showBooks(commit, readerId) {
    return new Promise((resolve, reject) => {
      axios.get(`admin/${readerId}/books`)
      .then((response) => {
        commit('SET_BOOKS', response.data)
        resolve(response)
      })
      .catch((error) => { reject(error) })
    })
  },
  showBook(commit, bookId) {
    return new Promise((resolve, reject) => {
      axios.get(`admin/books/${bookId}`)
      .then((response) => {
        commit('SET_BOOKS', response.data[0])
        resolve(response)
      })
      .catch((error) => { reject(error) })
    })
  }
}
