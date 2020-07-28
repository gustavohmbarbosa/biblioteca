import axios from '@/axios'

export default {
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
