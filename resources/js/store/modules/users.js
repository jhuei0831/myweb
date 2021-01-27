import router from "../../router/index.js"
import Swal from 'sweetalert2'
import { getField, updateField } from "vuex-map-fields";

const state = {
    user: [],
    users: [],
    errors:[],
    roles: [],
    user_role: [],
    loading: false,
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
    /**
     * 忘記密碼
     * @param {會員電子信箱} email 
     */
    forgot_password({ commit }, email) {
        state.loading = true
        axios.post('/api/forgot-password', email)
        .then((response) => {
            console.log(response)
            Swal.fire({
                title: response.data.message,
                text: '請至郵件帳號:'+email.email+'收取信件。',
                icon: 'success',
                confirmButtonText: '好喔',
            })
            state.loading = false
        })
        .catch((error) => {
            console.log(error.response)
            commit('action_errors', error.response.data.message);
        });
    },
    /**
     * 取得特定使用者資料
     * @param {使用者流水號} id 
     */
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
    /**
     * 取得所有使用者資料
     */
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
    /**
     * 建立使用者
     * @param {name, email, password, password_confirmation, role} formContents 
     */
    createUser({commit}, formContents) {
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/api/users-create', formContents)
            .then((response) => {
                router.push({ name: 'Users' })
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
                    title: '新增失敗',
                    icon: 'error',
                    confirmButtonText: '好喔',
                })
                commit('action_errors', error.response.data.errors)
            });
        });
    },
    /**
     * 修改特定使用者資料
     * @param {name, email, password, password_confirmation, role} formContents 
     * @param {使用者流水號} id 
     */
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
                        background: '#F1F8E9',
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
    /**
     * 使用者修改自己的資料
     * @param {name, email} formContents 
     * @param {使用者流水號} id 
     */
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
                        background: '#F1F8E9',
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
    /**
     * 使用者編輯大頭貼
     * @param {photo} formContents 
     * @param {*} id 
     */
    editPhoto({dispatch}, {formContents, id}) {
        axios.put('/api/user-photo/'+id, formContents)
        .then((response) => {
            dispatch('auth/getUser', null, { root: true })
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
                    background: '#F1F8E9',
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
                    toast: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    icon: 'success',
                    title: response.data.message,
                    background: '#F1F8E9',
                    timer: 3000,
                    timerProgressBar: true,
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