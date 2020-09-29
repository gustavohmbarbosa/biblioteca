/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleAuthorBookManagementState.js'
import mutations from './moduleAuthorBookManagementMutations.js'
import actions from './moduleAuthorBookManagementActions.js'
import getters from './moduleAuthorBookManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

