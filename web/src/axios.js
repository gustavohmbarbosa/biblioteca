// axios
import axios from 'axios'
import interceptors from '@/store/auth/interceptors'
const domain = ""

export default axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
  headers: {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
    'Access-Control-Allow-Headers': '*',
  },
  domain
  // You can add your headers here
})

axios.interceptors.response.use(interceptors)
