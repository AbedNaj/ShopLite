
import AdminLayout from '@/layouts/AdminLayout.vue'
import AdminLogin from '@/pages/admin/Login.vue'
import AdminDashboard from '@/pages/admin/Dashboard.vue'
import AdminCategories from '@/pages/admin/categories/Categories.vue'
import AdminCategoryCreate from '@/pages/admin/categories/CategoryCreate.vue'
import AdminCategoryEdit from '@/pages/admin/categories/CategoryEdit.vue'
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
            }, {
                path: 'categories',
                name: 'admin.categories',
                component: AdminCategories
            }
            , {
                path: 'category/create',
                name: 'admin.category.create',
                component: AdminCategoryCreate
            }
            , {
                path: 'category/:id/edit',
                name: 'admin.category.edit',
                component: AdminCategoryEdit
            }
        ]
    }
]
