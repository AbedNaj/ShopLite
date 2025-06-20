import DefaultLayout from '@/layouts/DefaultLayout.vue';
import ProductsPage from '@/pages/shop/products.vue';

export default [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {
                path: 'products',
                name: 'shop.products',
                component: ProductsPage,
            },

        ],
    },
];
