<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import axios from '@/axios'
import { Button } from '@/components/ui/button'
import DefaultHeader from '@/components/admin/default-header.vue'
import commonTable from '@/components/admin/CommonTable.vue'
const router = useRouter()

function routeToCreate() {
    router.push({ name: 'admin.subCategory.create' })

}
const data = ref([])
const totalData = ref()
const perPage = 10
const currentPage = ref(1)

const columns = [

    { key: 'name', label: 'Category Name' },
    { key: 'category.name', label: 'Category' },

]
async function fetchSubCategories() {
    try {
        const res = await axios.get('admin/subCategories', {
            params: { page: currentPage.value, per_page: perPage }
        })
        data.value = res.data.data
        totalData.value = res.data.last_page


    } catch (error) {
        console.error('Error fetching categories')

    }
}

onMounted(fetchSubCategories)
watch(currentPage, fetchSubCategories)
</script>

<template>

    <DefaultHeader title="Sub Categories" description="Organize and manage subcategories for your products.">
        <Button @click="routeToCreate()">Add New SubCategory</Button>

    </DefaultHeader>


    <commonTable @refresh-data="fetchSubCategories" delete-end-point="admin/subCategories"
        edit-route="admin.subCategory.edit" :columns="columns" :data="data" :enumMaps="enumMaps" :total="totalData"
        :perPage="perPage" :currentPage="currentPage" @page-change="(p) => currentPage = p">
        <template #actions="{ row }">

        </template>
    </commonTable>
</template>
