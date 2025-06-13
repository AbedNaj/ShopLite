import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/pages/Home.vue'
import adminRoutes from './admin'

const routes = [
    { path: '/', name: 'home', component: Home },
    ...adminRoutes,
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    }
})

import { useAuthStore } from '@/stores/auth'


let authInitPromise = null

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore()

    if (!authInitPromise) {
        authInitPromise = auth.init()
    }


    await authInitPromise

    const isAdminPage = to.path.startsWith('/admin')
    const isLoginPage = to.name === 'admin.login'


    const isAuthenticated = auth.token && auth.user

    if (isAdminPage && !isAuthenticated && !isLoginPage) {
        return next({ name: 'admin.login' })
    }

    if (isLoginPage && isAuthenticated) {
        return next({ name: 'admin.dashboard' })
    }

    return next()
})

export default router