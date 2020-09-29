/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

==========================================================================================*/


export default {
  ADD_AUTHOR_BOOK(state, author_book) {
    state.authors_books.push(author_book)
  },
  SET_AUTHORS_BOOKS(state, authors_books) {
    state.authors_books = authors_books
  },
  REMOVE_RECORD(state, itemId) {
      const userIndex = state.authors_books.findIndex((u) => u.id == itemId)
      state.authors_books.splice(userIndex, 1)
  },
}
