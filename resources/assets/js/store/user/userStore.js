export default {
    state: {
        authUser: null
    },
    mutations: {
        SET_AUTH_USER: (state, userObj) => {
            state.authUser = userObj;
        }
    },
    getters: {
        isLoggedIn: (state) => {
            return (state.authUser !== null && state.authUser.access_token !== 'undefined');
        },
        getAccessToken: (state) => {
            return (state.authUser !== null && state.authUser.access_token !== 'undefined') ? state.authUser.access_token : null;
        }
    },
    actions: {
        setUserObject: ({commit}, userObj) => {
            commit('SET_AUTH_USER', userObj);
        }
    }
}