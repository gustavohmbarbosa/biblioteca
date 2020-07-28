// axios
import axios from 'axios'

const domain = ""

export default axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
  domain
  // You can add your headers here
})
