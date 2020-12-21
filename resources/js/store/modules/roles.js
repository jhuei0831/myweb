import router from "../../router/index.js"

const state = {
    roles: [],
    loading: true,
}

const mutations = {
    roles_data(state, roles) {
        state.loading = false
        state.roles = roles
    },
}

const actions = {
    getRoles({ commit }) {
        axios.get('/api/roles')
        .then((response) => {
            commit('roles_data', response.data.data)
        })
        .catch(() => {
            router.push({ name: 'Home' })
        })
    },
}

const getters = {
    roles: state => state.roles,
    loading: state => state.loading,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}