import { createRouter, createWebHistory } from 'vue-router';

import Home from '@/pages/Home.vue';
import AdminLogin from '@/pages/admin/Login.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import AdminDashboard from '@/pages/admin/Dashboard.vue';

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/admin/login', name: 'admin.login', component: AdminLogin },

    {
        path: '/admin',
        component: AdminLayout,
        children: [
            {
                path: 'dashboard',
                name: 'admin.dashboard',
                component: AdminDashboard
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
