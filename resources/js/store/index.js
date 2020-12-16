import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

// 定義一個新的 Vue Store
const store = new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {}
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, token, user) {
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
        },
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    }
})
export default store;