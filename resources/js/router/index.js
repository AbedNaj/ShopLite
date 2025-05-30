import { createRouter, createWebHistory } from 'vue-router';

import Home from '@/pages/Home.vue';
import AdminLogin from '@/pages/admin/Login.vue';

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/admin/login', name: 'admin.login', component: AdminLogin },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
