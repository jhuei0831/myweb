import router from "../../router/index.js"
import Swal from 'sweetalert2'
import { getField, updateField } from "vuex-map-fields";
const state = {
    role: [],
    roles: [],
    errors:[],
    permissions: [],
    rolePermissions: [],
    loading: true,
}

const mutations = {
    updateField,
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
        state.loading = false
        state.permissions = permissions
    }
}

const actions = {
    getRole({ commit }, id) {
        state.loading = true
        axios.get('/api/role/'+id)
        .then((response) => {
            if (response.data.responseStatus) {
                Swal.fire({
                    title: response.data.responseMessage,
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
                router.push({ name: 'Roles' })
            }
            else{
                const payload = { role: response.data.role, rolePermissions: response.data.rolePermissions }
                commit('role_data', payload)
            }    
        })
        .catch(() => {
            // router.push({ name: 'Home' })
        })
    },
    getRoles({ commit }) {
        axios.get('/api/roles')
        .then((response) => {
            if (response.data.responseStatus) {
                Swal.fire({
                    title: response.data.responseMessage,
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
                router.push({ name: 'Home' })
            }
            else{
                commit('roles_data', response.data.data)
            }
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
                Swal.fire({
                    title: '新增失敗',
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
                commit('action_errors', error.response.data.errors);
            });
        });
    },
    editRoles({commit}, {formContents, id}) {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.put('/api/role-edit/'+id, formContents)
                .then((response) => {
                    router.push({name: 'Roles'})
                    Swal.fire({
                        toast: true,
                        showConfirmButton: false,
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        timer: 3000,
                        timerProgressBar: true,
                    })
                })
                .catch((error) => {
                    commit('action_errors', error.response.data.errors);
                });
        });
    },
    deleteConfirm({ dispatch }, id) {
        Swal.fire({
            title: "確定刪除?",
            icon: 'question',
            confirmButtonText: '確定',
            showDenyButton: true,
            denyButtonText: '再想想',
        }).then((result) => {
            if (result.isConfirmed) {      
                dispatch('deleteRole', id)
            } else if (result.isDenied) {                        
                Swal.fire({
                    toast: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    icon: 'info',
                    title: '資料已保留',
                    timer: 3000,
                    timerProgressBar: true,
                })
            }
        })
    },
    deleteRole({ dispatch }, id) {
        axios.delete('/api/role-delete/'+id)
        .then((response) => {
            if (response.data.responseStatus) {
                Swal.fire({
                    title: response.data.responseMessage,
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
            }
            else{
                if (response.data.status == 'failed') {
                    Swal.fire({
                        title: response.data.message,
                        icon: 'error',
                        confirmButtonText: '好喔',
                    })
                }
                else{
                    Swal.fire({
                        title: response.data.message,
                        icon: 'success',
                        confirmButtonText: '好喔',
                    })
                    dispatch('getRoles')
                }                           
            }
        })
        .catch((error) => {
            // console.log(error.response)
            // router.push({ name: 'Home' })
        })
    },
    getPermissions({ commit }) {
        state.loading = true
        axios.get('/api/permissions')
        .then((response) => {
            if (response.data.responseStatus) {
                Swal.fire({
                    title: response.data.responseMessage,
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
                router.push({ name: 'Roles' })
            }
            else{
                commit('permissions', response.data.data)
            }
        })
        .catch(() => {
            router.push({ name: 'Home' })
        })
    }
}

const getters = {
    getField,
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