import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/LoginComponent.vue'
import About from '../components/AboutComponent.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/vue',
        name: 'Home',
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