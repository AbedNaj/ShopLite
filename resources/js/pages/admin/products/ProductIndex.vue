<script setup>
import { Button } from '@/components/ui/button'
import DefaultHeader from '@/components/admin/default-header.vue'
import commonTable from '@/components/admin/CommonTable.vue'

import { useRouter } from 'vue-router'
import { ref, onMounted, watch } from 'vue'
import axios from '@/axios'
const router = useRouter()

function goToCreateProduct() {
    router.push({ name: 'admin.products.create' })
}

const products = ref([])
const totalProducts = ref()
const perPage = 10
const currentPage = ref(1)

const columns = [

    { key: 'name', label: 'Product Name' },
    { key: 'sub_category.name', label: 'Sub Category' },
    { key: 'description', label: 'Description' },
    { key: 'price', label: 'Price' },
    { key: 'discount_price', label: 'Discount' },
    { key: 'stock', label: 'Stock' },
]
async function fetchProducts() {
    try {
        const res = await axios.get('admin/products', {
            params: { page: currentPage.value, per_page: perPage }
        })

        products.value = res.data.data
        totalProducts.value = res.data.last_page


    } catch (error) {
        console.error('Error fetching Products')

    }
}
onMounted(() => {
    fetchProducts()

})
watch(currentPage, fetchProducts)
</script>
<template>

    <DefaultHeader title="Products" description="Manage Your Products.">

        <Button @click="goToCreateProduct">Add New Product</Button>
    </DefaultHeader>


    <commonTable @refresh-data="fetchProducts" delete-end-point="admin/products" edit-route="admin.products.edit"
        :columns="columns" :data="products" :enumMaps="enumMaps" :total="totalProducts" :perPage="perPage"
        :currentPage="currentPage" @page-change="(p) => currentPage = p">
        <template #actions="{ row }">

        </template>
    </commonTable>
</template>