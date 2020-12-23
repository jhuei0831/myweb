import router from "../../router/index.js"
import Swal from 'sweetalert2'

const state = {
    roles: [],
    role: [],
    errors:[],
    permissions: [],
    rolePermissions: [],
    loading: true,
}

const mutations = {
    role_data(state, {role, rolePermissions}) {
        state.loading = false
        state.role = role
        state.rolePermissions = rolePermissions
    },
    roles_data(state, roles) {
        state.loading = false
        state.roles = roles
    },
    action_errors(state, error) {
        state.errors.push(error)
    },
    permissions(state, permissions) {
        state.permissions = permissions
    }
}

const actions = {
    getRole({ commit }, id) {
        axios.get('/api/role/'+id)
        .then((response) => {
            const payload = { role: response.data.role, rolePermissions: response.data.rolePermissions }
            commit('role_data', payload)
        })
        .catch(() => {
            // router.push({ name: 'Home' })
        })
    },
    getRoles({ commit }) {
        axios.get('/api/roles')
        .then((response) => {
            commit('roles_data', response.data.data)
        })
        .catch(() => {
            router.push({ name: 'Home' })
        })
    },   
    createRoles({commit}, formContents) {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/roles-create', formContents)
            .then((response) => {
                router.push({ name: 'Roles' })
                Swal.fire({
                    title: response.data.message,
                    icon: 'success',
                    confirmButtonText: '好喔',
                })
            })
            .catch((error) => {
                console.log(error.response.data.errors)
                commit('action_errors', error.response.data.errors);
            });
        });
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
    role: state => state.role,
    errors: state => state.errors,
    loading: state => state.loading,
    permissions: state => state.permissions,
    rolePermissions: state => state.rolePermissions,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}