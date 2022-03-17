import { getCookieValue } from './util'

window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.axios.interceptors.request.use(config => {
    // クッキーからトークンを取り出してヘッダーに添付する
    config.headers['X-XSRF-TOKEN'] = getCookieValue('XSRF-TOKEN')
  
    return config
})
  
