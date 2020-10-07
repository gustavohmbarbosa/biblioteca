/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

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
