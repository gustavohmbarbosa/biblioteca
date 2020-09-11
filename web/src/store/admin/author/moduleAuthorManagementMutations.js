/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  ADD_AUTHOR(state, author) {
    state.authors.push(author)
  },
  SET_AUTHORS(state, authors) {
    state.authors = authors
  },
  REMOVE_RECORD(state, itemId) {
      const authorIndex = state.authors.findIndex((u) => u.id == itemId)
      state.authors.splice(authorIndex, 1)
  },
}
