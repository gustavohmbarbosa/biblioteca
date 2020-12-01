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
  store({ commit }, loan, config) {
    return new Promise((resolve, reject) => {
      axios.post("admin/loans/", loan, { headers: config })
        .then((response) => {
          commit('ADD_LOANS', Object.assign(loan , {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  update(context, { loan, loanId }, config) {
    return new Promise((resolve, reject) => {
      axios.put(`admin/loans/${loanId}`, loan, { headers: config })
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
  destroy({ commit }, loanId) {
    return new Promise((resolve, reject) => {
      axios.delete(`admin/loans/${loanId}`)
        .then((response) => {
          commit('REMOVE_RECORD', loanId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
}
