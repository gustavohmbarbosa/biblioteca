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
  UPDATE_COMPANY(state, company) {
    state.companies = state.companies.map((item) => item.id === company.id ? company : item)
  },
  REMOVE_COMPANY(state, itemId) {
      const companyIndex = state.companies.findIndex((u) => u.id == itemId)
      state.companies.splice(companyIndex, 1)
  },
}
