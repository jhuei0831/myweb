import router from "../../router/index.js"
import Swal from 'sweetalert2'
import { getField, updateField } from "vuex-map-fields";

const state = {
    log: [],
    logs: [],
    loading: false
}

const mutations = {
    updateField,
    log_data(state, log) {
        state.loading = false
        state.log = log
    },
    logs_data(state, logs) {
        state.loading = false
        state.logs = logs
    },
}

const actions = {
    getLog({ commit }, id) {
        // state.loading = true
        axios.get('/api/log/'+id)
        .then((response) => {
            if(!response.data.user_role) {
                const payload = { user: response.data.user, user_role: [] }
                commit('log_data', payload)
            }
            else{
                const payload = { user: response.data.user, user_role: response.data.user_role }
                commit('log_data', payload)
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
    getLogs({ commit }) {
        axios.get('/api/logs')
        .then((response) => {
            commit('logs_data', response.data.data)
        })
        .catch((error) => {
            console.log(error.response)
            Swal.fire({
                title: error.response.data.responseMessage,
                icon: 'error',
                confirmButtonText: '好喔',
            })
            // router.push({ name: 'Home' })
        })
    },   
}

const getters = {
    getField,
    logs: state => state.logs,
    log: state => state.log,
    loading: state => state.loading,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}