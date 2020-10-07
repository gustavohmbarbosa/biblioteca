export default {
  hasToken({ token }) {
    if(token) {
      return true
    } else {
      return false
    }
  },
  getUser({ user }) {
    return user
  }
}
