import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/LoginComponent.vue'
import About from '../components/AboutComponent.vue'
import Roles from '../components/roles/RolesComponent.vue'
import RolesCreate from '../components/roles/CreateComponent.vue'
import RolesEdit from '../components/roles/EditComponent.vue'
import Users from '../components/users/UsersComponent.vue'
import UsersCreate from '../components/users/CreateComponent.vue'
import UsersEdit from '../components/users/EditComponent.vue'
import Logs from '../components/logs/LogsComponent.vue'
import LogDetail from '../components/logs/DetailComponent.vue'
import NotFound from '../components/NotFound.vue'
import Home from '../components/HomeComponent.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/about',
        name: 'About',
        meta: {
            auth: true
        },
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
        path: '/users',
        name: 'Users',
        meta: { auth: true },
        component: Users
    },
    {
        path: '/users/create',
        name: 'UsersCreate',
        meta: { auth: true },
        component: UsersCreate,
    },
    {
        path: '/users/edit/:id',
        name: 'UsersEdit',
        meta: { auth: true },
        component: UsersEdit,
    },
    {
        path: '/logs',
        name: 'Logs',
        meta: { auth: true },
        component: Logs
    },
    {
        path: '/logs/detail/:id',
        name: 'LogDetail',
        meta: { auth: true },
        component: LogDetail
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '*',
        name: 'NotFound',
        component: NotFound
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