// axios
import axios from 'axios'
import interceptors from '@/store/auth/interceptors'
const domain = ""

export default axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
  domain,
})

axios.interceptors.response.use(interceptors)
