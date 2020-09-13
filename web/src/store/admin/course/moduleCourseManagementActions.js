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
      axios.get("admin/courses")
        .then((response) => {
          commit('SET_COURSES', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  store({ commit }, course) {
    return new Promise((resolve, reject) => {
      axios.post("/admin/courses", course)
        .then((response) => {
          commit('ADD_COURSE', Object.assign(course, {id: response.data.id}))
          resolve(response)
        })
        .catch((error) =>
        {
          reject(error)
        })
    })
  },
  destroy({ commit }, courseId) {
    return new Promise((resolve, reject) => {
      axios.delete(`admin/courses/${courseId}`)
        .then((response) => {
          commit('REMOVE_RECORD', courseId)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  }
}
