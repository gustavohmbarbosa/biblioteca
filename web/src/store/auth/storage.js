import axios from '@/axios'

export default {
  // User
  getLocalUser() {
    return JSON.parse(localStorage.getItem('user'))
  },
  deleteLocalUser() {
    localStorage.removeItem('user')
  },
  setLocalUser(user) {
    localStorage.setItem('user', JSON.stringify(user))
  },

  // Token
  getLocalToken() {
    return localStorage.getItem('token')
  },
  deleteLocalToken() {
    localStorage.removeItem('token')
  },
  setLocalToken(token) {
    localStorage.setItem('token', token)
  },
  setHeaderToken(token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
  }
}
