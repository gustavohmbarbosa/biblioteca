/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------

==========================================================================================*/


export default {
  ADD_COMPANY(state, company) {
    state.companies.push(company)
  },
  SET_COMPANIES(state, companies) {
    state.companies = companies
  },
  REMOVE_RECORD(state, itemId) {
      const companyIndex = state.companies.findIndex((u) => u.id == itemId)
      state.companies.splice(companyIndex, 1)
  },
}
