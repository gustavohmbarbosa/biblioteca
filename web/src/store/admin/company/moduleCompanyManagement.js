/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleCompanyManagementState.js'
import mutations from './moduleCompanyManagementMutations.js'
import actions from './moduleCompanyManagementActions.js'
import getters from './moduleCompanyManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

