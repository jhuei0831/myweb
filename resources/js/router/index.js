import Vue from 'vue'
import VueRouter from 'vue-router'
import Swal from 'sweetalert2'
import Login from '../components/LoginComponent.vue'
import About from '../components/AboutComponent.vue'
import Roles from '../components/roles/RolesComponent.vue'
import RolesCreate from '../components/roles/CreateComponent.vue'

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
        beforeEnter: (to, from, next) => {
            if (!window.Permissions.includes('role-create1')) {
                Swal.fire({
                    title: '您無權操作!',
                    icon: 'error',
                    confirmButtonText: '好喔'
                })
                next('/roles')
                return
            }
            else next()
        }
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