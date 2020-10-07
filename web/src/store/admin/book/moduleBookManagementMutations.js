/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

==========================================================================================*/


export default {
  ADD_BOOK(state, book) {
    state.books.push(book)
  },
  SET_BOOKS(state, books) {
    state.books = books
  },
  REMOVE_RECORD(state, itemId) {
      const userIndex = state.books.findIndex((u) => u.id == itemId)
      state.books.splice(userIndex, 1)
  },
}
