import router from "../../router/index.js"
import Swal from 'sweetalert2'
import { getField, updateField } from "vuex-map-fields";

const state = {
    product:[],
    products:[],
    errors:[],
    loading:false,
}

const mutations = {
    updateField,
    product_data(state, product) {
        state.product = product
    },
    products_data(state, products) {
        state.products = products
    },
    action_errors(state, error) {
        state.errors.push(error)
    },
    clean_errors(state) {
        state.errors = []
    },
}

const actions = {
    getProducts({commit}) {
        axios.get('/api/products')
        .then((response) => {
            commit('products_data', response.data.data)
        })
        .catch((error) => {
            Swal.fire({
                title: error.response.data.responseMessage,
                icon: 'error',
                confirmButtonText: '好喔',
            })
            router.push({ name: 'Home' })
        })
    }
}

const getters = {
    getField,
    products: state => state.products,
    loading: state => state.loading,
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}