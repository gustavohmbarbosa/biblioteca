/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleLoanManagementState.js'
import mutations from './moduleLoanManagementMutations.js'
import actions from './moduleLoanManagementActions.js'
import getters from './moduleLoanManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

