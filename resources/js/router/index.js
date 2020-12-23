import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/LoginComponent.vue'
import About from '../components/AboutComponent.vue'
import Roles from '../components/roles/RolesComponent.vue'
import RolesCreate from '../components/roles/CreateComponent.vue'
import RolesEdit from '../components/roles/EditComponent.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
    },
    {
        path: '/about',
        name: 'About',
        meta: { auth: true },
        component: About
    },
    {
        path: '/roles',
        name: 'Roles',
        meta: { auth: true },
        component: Roles
    },
    {
        path: '/roles/create',
        name: 'RolesCreate',
        meta: { auth: true },
        component: RolesCreate,
    },
    {
        path: '/roles/edit/:id',
        name: 'RolesEdit',
        meta: { auth: true },
        component: RolesEdit,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    const isLogged = localStorage.getItem('token')

    if (to.matched.some(record => record.meta.auth) && !isLogged) {
        next('/login')
        return
    }
    next()
})

export default router