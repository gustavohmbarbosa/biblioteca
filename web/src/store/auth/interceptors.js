import store from '../store'

const pushToLogin = () => {
  return ({ status }) => {
    if (status === 401) {
      store.dispatch('auth/signOut')
      window._Vue.$router.push({ name: 'page-login' })
    }
  }
}

export default pushToLogin
