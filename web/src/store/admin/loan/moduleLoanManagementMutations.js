/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

==========================================================================================*/


export default {
  ADD_LOANS(state, loan) {
    state.loans.push(loan)
  },
  SET_LOANS(state, loans) {
    state.loans = loans
  },
  REMOVE_RECORD(state, itemId) {
    const loanIndex = state.loans.findIndex((loan) => loan.id == itemId)
    state.loan.splice(loanIndex, 1)
  }
}
