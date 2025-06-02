
import AdminLayout from '@/layouts/AdminLayout.vue'
import AdminLogin from '@/pages/admin/Login.vue'
import AdminDashboard from '@/pages/admin/Dashboard.vue'

export default [
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
]
