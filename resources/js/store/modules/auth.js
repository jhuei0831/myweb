import router from "../../router/index.js"
import Swal from 'sweetalert2'

const state = {
    token: localStorage.getItem('token') || '',
    user: [],
    errors:[],
    loading: false,
    allow: false
}

const mutations = {
    auth_request(state) {
        state.loading = true
    },
    auth_success(state, token) {
        state.loading = false
        state.token = token
    },
    auth_error(state, error) {
        state.loading = false
        state.errors.push(error)
    },
    auth_user(state, user) {
        state.user = user
    },
    auth_logout(state) {
        state.token = ''
        state.user = []
    }
}

const actions = {
    getUser({ commit }) {
        axios.get('/api/user')
        .then((response) => {
            commit('auth_user', response.data.user)
            window.Permissions = response.data.permission
        })
        .catch(() => {
            localStorage.removeItem("token")
            commit('auth_logout')
            Swal.fire({
                title: '請重新登入',
                icon: 'error',
                confirmButtonText: '好喔',
            })
        })
    },
    getPermission({commit}, {permission}) {
        state.allow = false
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/get-permission', {permission: permission})
            .then((response) => {
                if (!response.data.allow) {
                    Swal.fire({
                        title: '您無權操作!',
                        icon: 'error',
                        confirmButtonText: '好喔',
                    })
                    router.go(-1) 
                }
                else{
                    state.allow = true
                }
            })
            .catch(() => {
                router.push({ name: 'Home' })
            })
        });
    },
    login({commit, dispatch}, formContents) {
        commit('auth_request')
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/login', formContents)
            .then((response) => {
                const token = response.data.token;
                localStorage.setItem('token', token);
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                commit('auth_success', token);
                router.push({ name: 'About' })
                dispatch('getUser')
            })
            .catch((error) => {
                commit('auth_error', error.response.data.message);
            });
        });
    },
    logout({ commit }) {
        axios.get('api/logout')
        .then((response) => {
            localStorage.removeItem("token")
            commit("auth_logout")
            router.push({ name: "Login" })
            Swal.fire({
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                icon: 'success',
                title: response.data.message,
                background: '#F1F8E9',
                timer: 3000,
                timerProgressBar: true,
            })
        })
        .catch((error) => {
            Swal.fire({
                title: error.response.data.message,
                icon: 'error',
                confirmButtonText: '好喔',
            })
        })
    },
}

const getters = {
    isLoggedIn: state => !!state.token,
    userdata: state => state.user,
    loading: state => state.loading,
    errors: state => state.errors,
    allow: state => state.allow,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}