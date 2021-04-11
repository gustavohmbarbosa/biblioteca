/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------

==========================================================================================*/

import axios from "@/services/axios"

export default {
  index({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get("admin/companies")
        .then((response) => {
          commit('SET_COMPANIES', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, company) {
    return new Promise((resolve, reject) => {
      axios.post("/admin/companies", company)
        .then((response) => {
          commit('ADD_COMPANY', Object.assign(company, {id: response.data.id}))
          resolve(response)
        })
        .catch((error) =>
        {
          reject(error)
        })
    })
  },
  show(context, companyId) {
    return new Promise((resolve, reject) => {
      axios.get(`admin/companies/${companyId}`)
        .then((response) => {
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  destroy({ commit }, companyId) {
    return new Promise((resolve, reject) => {
      axios.delete(`admin/companies/${companyId}`)
        .then((response) => {
          commit('REMOVE_RECORD', companyId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
