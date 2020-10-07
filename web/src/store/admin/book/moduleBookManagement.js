/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleBookManagementState.js'
import mutations from './moduleBookManagementMutations.js'
import actions from './moduleBookManagementActions.js'
import getters from './moduleBookManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

