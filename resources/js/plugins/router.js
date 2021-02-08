export default {
  _baseUrl: (process.env.ENCORE_HTTP_URL || '/'),
  to(uri) {
    window.location.href = this._baseUrl + uri
  }
}
