/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

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
