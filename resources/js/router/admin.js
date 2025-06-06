
import AdminLayout from '@/layouts/AdminLayout.vue'
import AdminLogin from '@/pages/admin/login.vue'
import AdminDashboard from '@/pages/admin/Dashboard.vue'
import AdminCategories from '@/pages/admin/categories/Categories.vue'
import AdminCategoryCreate from '@/pages/admin/categories/CategoryCreate.vue'
import AdminCategoryEdit from '@/pages/admin/categories/CategoryEdit.vue'
import AdminSubCategoryIndex from '@/pages/admin/subCategories/SubCategoryIndex.vue'
import AdminSubCategoryCreate from '@/pages/admin/subCategories/SubCategoryCreate.vue'
import AdminSubCategoryEdit from '@/pages/admin/subCategories/subCategoryEdit.vue'
import AdminProductsIndex from '@/pages/admin/products/ProductIndex.vue'
import AdminProductsCreate from '@/pages/admin/products/productCreate.vue'
import AdminProductsEdit from '@/pages/admin/products/ProductEdit.vue'

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
            , {
                path: 'sub-category',
                name: 'admin.subCategory.index',
                component: AdminSubCategoryIndex
            }
            , {
                path: 'sub-category/create',
                name: 'admin.subCategory.create',
                component: AdminSubCategoryCreate
            }
            , {
                path: 'sub-category/:id/edit',
                name: 'admin.subCategory.edit',
                component: AdminSubCategoryEdit
            }
            , {
                path: 'products',
                name: 'admin.products.index',
                component: AdminProductsIndex
            }
            , {
                path: 'products/create',
                name: 'admin.products.create',
                component: AdminProductsCreate
            }
            , {
                path: 'products/:id/edit',
                name: 'admin.products.edit',
                component: AdminProductsEdit
            }
        ]
    }
]
