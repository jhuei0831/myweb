import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import logs from './modules/logs';
import roles from './modules/roles';
import users from './modules/users';
import products from './modules/products';

Vue.use(Vuex);

// 定義一個新的 Vue Store
const store = new Vuex.Store({
    state: {
        
    },
    action: {
        
    },
    mutations: {
        
    },
    getters: {
        
    },
    modules: {
        auth,
        logs,
        roles,
        users,
        products
    }
})
export default store;