export default {
  show(msg, config = {}) {
    alert(msg)
  },
  error(msg, config = {}) {
    config['type'] = 'error'
    this.show(msg)
  }
}
