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
  UPDATE_AUTHOR(state, author) {
    state.authors = state.authors.map((item) => item.id === author.id ? author : item)
  },
  REMOVE_AUTHOR(state, itemId) {
      const authorIndex = state.authors.findIndex((u) => u.id == itemId)
      state.authors.splice(authorIndex, 1)
  },
}
