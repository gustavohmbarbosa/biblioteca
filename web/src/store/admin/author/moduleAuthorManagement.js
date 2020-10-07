/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleAuthorManagementState.js'
import mutations from './moduleAuthorManagementMutations.js'
import actions from './moduleAuthorManagementActions.js'
import getters from './moduleAuthorManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

