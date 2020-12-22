import router from "../../router/index.js"

const state = {
    roles: [],
    permissions: [],
    loading: true,
}

const mutations = {
    roles_data(state, roles) {
        state.loading = false
        state.roles = roles
    },
    permissions(state, permissions) {
        state.permissions = permissions
    }
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
    getPermissions({ commit }) {
        axios.get('/api/permissions')
        .then((response) => {
            commit('permissions', response.data.data)
        })
        .catch(() => {
            router.push({ name: 'Home' })
        })
    }
}

const getters = {
    roles: state => state.roles,
    loading: state => state.loading,
    permissions: state => state.permissions,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}