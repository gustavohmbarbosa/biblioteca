/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  SET_BOOKS(state, books) {
    state.books = books
  },
  REMOVE_RECORD(state, itemId) {
      const userIndex = state.books.findIndex((u) => u.id == itemId)
      state.books.splice(userIndex, 1)
  },
}
