let timeout = null

export default {
  _el: false,
  _getEl(force = false) {
    if (this._el === false || force) {
      this._el = document.querySelector('#loading')
    }
    return this._el
  },
  _loadingShow(is, showMsg) {
    if (!this._getEl()) {
      return
    }
    if (is) {
      this._getEl(true).innerHTML = showMsg
    }
    this._getEl().style.display = is ? 'block': 'none'
  },
  show(msg) {
    if (!msg) {
      msg = 'loading...'
    }
    this._loadingShow(true, msg)
  },
  hide() {
    clearInterval(timeout)
    this._loadingShow(false)
  },
  delayShow(delay, msg) {
    if (delay === undefined) {
      delay = 500
    }
    timeout = setTimeout(() => {
      this.show(msg)
    }, delay)
  }
}
