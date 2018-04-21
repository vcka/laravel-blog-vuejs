import store from '../store/store';

export default {
    setToken(data) {
        window.localStorage.setItem('user', JSON.stringify(data));
        this.dispatchUserObj();
    },
    dispatchUserObj() {
        var userObj = JSON.parse(window.localStorage.getItem('user'));
        store.dispatch('setUserObject', userObj);
    },
    isLoggedIn() {
        return store.getters.isLoggedIn;
    },
    logout() {
        window.localStorage.removeItem('user');
        store.dispatch('setUserObject', null);
    }
}