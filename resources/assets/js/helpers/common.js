import axios from 'axios';
import store from '../store/store';

export default {
    makeUrl(url, isSecure) {
        url = `/api/${url}`;
        if (isSecure) {
            var accessToken = store.getters.getAccessToken;
            if (url.indexOf('?') === -1) {
                url += `?token=${accessToken}`;
            } else {
                url += `&token=${accessToken}`;
            }
        }
        return url;
    },
    getAxios(getUrl, getSecure = false) {
        var secureUrl = this.makeUrl(getUrl, getSecure);
        return new Promise((resolve, reject) => {
            //{headers: {'X-CSRF-Token': _token}}
            var headers = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-Token': _token
            };
            axios.get(secureUrl, {headers: headers}).then(({ data }) => {
                resolve(data);
            }).catch(error => {
                reject(error);
            });
        });
    },
    postAxios(postUrl, params, postSecure = false) {
        var secureUrl = this.makeUrl(postUrl, postSecure);
        return new Promise((resolve, reject) => {
            //'X-CSRF-Token': _token,
            var headers = {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': _token
            };
            axios.post(secureUrl, $.param(params), {headers: headers}).then(({ data }) => {
                resolve(data);
            }).catch(error => {
                reject(error);
            });
        });
    }
}