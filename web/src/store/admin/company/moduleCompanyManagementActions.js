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
}
