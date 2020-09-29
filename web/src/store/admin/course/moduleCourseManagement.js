/*=========================================================================================
  File Name: moduleUserManagement.js
  Description: Calendar Module
  ----------------------------------------------------------------------------------------

==========================================================================================*/


import state from './moduleCourseManagementState.js'
import mutations from './moduleCourseManagementMutations.js'
import actions from './moduleCourseManagementActions.js'
import getters from './moduleCourseManagementGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters
}

