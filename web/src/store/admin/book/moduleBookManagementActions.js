/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from "@/axios.js"

export default {
  store({ commit }, book) {
    alert('foi poh');
    return new Promise((resolve, reject) => {
      axios.post("/admin/books", {book: book})
        .then((response) => {
          console.log(response)
          commit('ADD_BOOK', Object.assign(book, {id: response.data.id}))
          resolve(response)
        })
        .catch((error) => 
        { 
          console.log(error) 
          reject(error) 
        })
    })
  },
}