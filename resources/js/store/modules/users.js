import router from "../../router/index.js"
import Swal from 'sweetalert2'
import { getField, updateField } from "vuex-map-fields";

const state = {
    user: [],
    users: [],
    errors:[],
    roles: [],
    user_role: [],
    loading: true,
}

const mutations = {
    updateField,
    user_data(state, {user, user_role}) {
        state.loading = false
        state.user = user
        state.user_role = user_role
    },
    users_data(state, users) {
        state.loading = false
        state.users = users
    },
    action_errors(state, error) {
        state.errors.push(error)
    },
    clean_errors(state) {
        state.errors = []
    },
    roles(state, roles) {
        state.loading = false
        state.roles = roles
    }
}

const actions = {
    getUser({ commit }, id) {
        // state.loading = true
        axios.get('/api/user/'+id)
        .then((response) => {
            if(!response.data.user_role) {
                const payload = { user: response.data.user, user_role: [] }
                commit('user_data', payload)
            }
            else{
                const payload = { user: response.data.user, user_role: response.data.user_role }
                commit('user_data', payload)
            }    
        })
        .catch((error) => {
            // Swal.fire({
            //     title: error.response.data.responseMessage,
            //     icon: 'error',
            //     confirmButtonText: '好喔',
            // })
            // router.push({ name: 'Users' })
        })
    },
    getUsers({ commit }) {
        axios.get('/api/users')
        .then((response) => {
            commit('users_data', response.data.data)
        })
        .catch((error) => {
            Swal.fire({
                title: error.response.data.responseMessage,
                icon: 'error',
                confirmButtonText: '好喔',
            })
            router.push({ name: 'Home' })
        })
    },   
    createUser({commit}, formContents) {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/users-create', formContents)
            .then((response) => {
                router.push({ name: 'Users' })
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
                commit('action_errors', error.response.data.errors)
            });
        });
    },
    editUser({commit}, {formContents, id}) {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.put('/api/user-edit/'+id, formContents)
                .then((response) => {
                    if (response.data.status == 'failed') {
                        commit('action_errors', response.data.errors);
                    }
                    else{
                        router.push({name: 'Users'})
                        Swal.fire({
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                    }
                })
                .catch((error) => {                  
                    commit('action_errors', error.response.data.errors);
                });
        });
    },
    editSelf({commit}, {formContents, id}) {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.put('/api/user-edit-self/'+id, formContents)
                .then((response) => {
                    if (response.data.status == 'failed') {
                        commit('action_errors', response.data.errors);
                    }
                    else{
                        Swal.fire({
                            toast: true,
                            showConfirmButton: false,
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.message,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                    }
                })
                .catch((error) => {           
                    // console.log(error.response)
                    commit('action_errors', error.response.data.errors);
                });
        });
    },
    editPhoto({dispatch}, {formContents, id}) {
        axios.put('/api/user-photo/'+id, formContents)
        .then(() => {
            dispatch('auth/getUser', null, { root: true })
        })
        .catch(function (error) {
            console.log(error.response)
        })
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
                dispatch('deleteUser', id)
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
    deleteUser({ dispatch }, id) {
        axios.delete('/api/user-delete/'+id)
        .then((response) => {
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
                dispatch('getUsers')
            }   
        })
        .catch((error) => {
            Swal.fire({
                title: error.response.data.responseMessage,
                icon: 'error',
                confirmButtonText: '好喔',
            })
            // router.push({ name: 'Home' })
        })
    },
    getRoles({ commit }) {
        state.loading = true
        axios.get('/api/user/roles')
        .then((response) => {
            commit('roles', response.data.data)
        })
        .catch((error) => {
            Swal.fire({
                title: error.response.data.responseMessage,
                icon: 'error',
                confirmButtonText: '好喔',
            })
            router.push({ name: 'Users' })
        })
    }
}

const getters = {
    getField,
    users: state => state.users,
    user: state => state.user,
    errors: state => state.errors,
    loading: state => state.loading,
    roles: state => state.roles,
    user_role: state => state.user_role,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}