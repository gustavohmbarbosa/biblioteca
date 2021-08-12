import axios from 'axios'

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

api.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  config.headers.Authorization = `Bearer ${token}`;

  return config;
});

api.interceptors.response.use(response => response, error => {
  if (error.status === 401) {
    localStorage.removeItem('token');
    axios.defaults.headers.common.Authorization = '';

    location.href = 'http://localhost:8080/pages/login';
  }

  return Promise.reject(error);
});

export default api
