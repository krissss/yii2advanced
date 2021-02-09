import axios from "axios";
import loading from "./loading";
import message from "./message";

const instance = axios.create({
  baseURL: (process.env.WEBPACK_HTTP_BASE_URL || '/'),
  timeout: 5000,
  withCredentials: false
});
instance.interceptors.request.use(config => {
  if (config.headers.showLoading !== false) {
    loading.delayShow(config.headers.loadingDelay, config.headers.loadingMsg)
  }
  delete config.headers.showLoading
  delete config.headers.loadingDelay
  delete config.headers.loadingMsg

  config.headers['access-token'] = window.localStorage.getItem('ACCESS_TOKEN')

  return config
}, error => {
  loading.hide()
  console.warn(error)
})
instance.interceptors.response.use(response => {
  loading.hide()

  return response
}, error=> {
  loading.hide()
  if (error.response) {
    const {status, data} = error.response
    if (status === 401) {
      window.location.href = '/wechat/auth'
      return Promise.reject('No Auth')
    }
    if (status === 422) {
      const msg = data.errors[0].message
      message.error(msg)
      return Promise.reject(msg)
    }
    if (status === 500) {
      const msg = data.message
      message.error(msg)
      return Promise.reject(msg)
    }
  }
  return Promise.reject(error)
})

export default {
  instance,
  get(uri, params = {}, headers = {}) {
    return new Promise((resolve, reject) => {
      this.instance.get(uri, {headers, params})
        .then(res => {
          resolve(res.data)
        }).catch(err => {
        reject(err)
      })
    })
  },
  post(uri, params = {}, headers = {}) {
    return new Promise((resolve, reject) => {
      this.instance.post(uri, params, {headers})
        .then(res => {
          resolve(res.data)
        }).catch(err => {
          reject(err)
      })
    })
  }
}
