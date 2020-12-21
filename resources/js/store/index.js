import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import roles from './modules/roles';

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
        roles
    }
})
export default store;