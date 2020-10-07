/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------

==========================================================================================*/

import axios from "@/axios.js"

export default {
  index({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("admin/loans")
        .then((response) => {
          commit('SET_LOANS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, reader, config) {
    return new Promise((resolve, reject) => {
      axios.post("admin/readers/", reader, { headers: config })
        .then((response) => {
          commit('ADD_READERS', Object.assign(reader , {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  update(context, { reader, readerId }, config) {
    return new Promise((resolve, reject) => {
      axios.put(`admin/readers/${readerId}`, reader, { headers: config })
      .then((response) => {
        resolve(response)
      })
      .catch((error) => { reject(error) })
    })
  },
  show(context, loanId) {
    return new Promise((resolve, reject) => {
      axios.get(`admin/loans/${loanId}`)
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
