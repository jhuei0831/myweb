import router from "../../router/index.js"

const state = {
    token: localStorage.getItem('token') || '',
    user: [],
    errors:[],
    loading: false,
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
    login({commit}, formContents) {
        commit('auth_request')
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('/api/login', formContents)
            .then((response) => {
                const token = response.data.token;
                localStorage.setItem('token', token);
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                commit('auth_success', token);
                router.push({ name: 'About' })
                location.reload();
            })
            .catch((error) => {
                commit('auth_error', error.response.data.message);
            });
        });
    },
    getUser({ commit }) {
        axios.get('/api/user')
        .then((response) => {
            commit('auth_user', response.data.data)
        })
        .catch(() => {
            router.push({ name: 'Home' })
        })
    },
    logout({ commit }) {
        axios.get('api/logout')
        .then(() => {
            localStorage.removeItem("token")
            commit("auth_logout")
            router.push({ name: "Home" })
            location.reload()
        })
        .catch((error) => {
            console.log(error.response.data.message)
        })
    },
}

const getters = {
    isLoggedIn: state => !!state.token,
    userdata: state => state.user,
    loading: state => state.loading,
    errors: state => state.errors,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}