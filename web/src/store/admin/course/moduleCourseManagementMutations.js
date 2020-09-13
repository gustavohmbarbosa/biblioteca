/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_COURSE(state, company) {
    state.courses.push(company)
  },
  SET_COURSES(state, courses) {
    state.courses = courses
  },
  REMOVE_RECORD(state, itemId) {
      const courseIndex = state.courses.findIndex((u) => u.id == itemId)
      state.courses.splice(courseIndex, 1)
  },
}
