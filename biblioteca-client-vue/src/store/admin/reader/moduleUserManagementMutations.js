/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  SET_USERS(state, readers) {
    state.readers = readers
  },
  REMOVE_RECORD(state, itemId) {
      const userIndex = state.readers.findIndex((u) => u.id == itemId)
      state.readers.splice(userIndex, 1)
  },
}
