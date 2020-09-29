/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleReaderManagementState.js'
import mutations from './moduleReaderManagementMutations.js'
import actions from './moduleReaderManagementActions.js'
import getters from './moduleReaderManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

