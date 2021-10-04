/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------

==========================================================================================*/

import axios from "@/services/axios"

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
  store({ commit }, reader) {
    return new Promise((resolve, reject) => {
      axios.post("admin/readers/", reader, {
        headers: {
          "Content-Type": 'multipart/form-data',
        }
      }).then((response) => {
          commit('ADD_READERS', Object.assign(reader , {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  update(context, { reader, readerId }) {
    return new Promise((resolve, reject) => {
      axios.put(`admin/readers/${readerId}`, reader)
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
