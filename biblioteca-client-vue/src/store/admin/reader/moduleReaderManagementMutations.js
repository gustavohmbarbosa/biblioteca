/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  SET_READERS(state, readers) {
    state.readers = readers
  },
  REMOVE_RECORD(state, itemId) {
      const readerIndex = state.readers.findIndex((reader) => reader.id == itemId)
      state.readers.splice(readerIndex, 1)
  },
}