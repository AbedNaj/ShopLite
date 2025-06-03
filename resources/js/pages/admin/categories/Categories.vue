<script setup>
import { Button } from '@/components/ui/button'
import DefaultHeader from '@/components/admin/default-header.vue'
import commonTable from '@/components/admin/CommonTable.vue'
import { CategoryStatusMap } from '@/enums/appEnums'
import { useRouter } from 'vue-router'
const router = useRouter()

function goToCreateCategory() {
    router.push({ name: 'admin.category.create' })
}

function goToEditCategory(categoryId) {
    router.push({ name: 'admin.category.edit', params: { id: categoryId } })
}
import { ref, onMounted, watch } from 'vue'
import axios from '@/axios'

const categories = ref([])
const totalCategories = ref()
const perPage = 10
const currentPage = ref(1)

const columns = [

    { key: 'name', label: 'Category Name' },
    { key: 'description', label: 'Description' },
    { key: 'is_active', label: 'Status' },
]
const enumMaps = {
    is_active: CategoryStatusMap
}
async function fetchCategories() {
    try {
        const res = await axios.get('admin/categories', {
            params: { page: currentPage.value, per_page: perPage }
        })
        categories.value = res.data.data
        totalCategories.value = res.data.last_page


    } catch (error) {
        console.error('Error fetching categories:', error)

    }
}

onMounted(fetchCategories)
watch(currentPage, fetchCategories)
</script>

<template>
    <DefaultHeader title="Categories" description="Manage your product categories.">
        <Button @click="goToCreateCategory">Add New Category</Button>

    </DefaultHeader>

    <commonTable @refresh-data="fetchCategories" edit-route="admin.category.add" :columns="columns" :data="categories"
        :enumMaps="enumMaps" :total="totalCategories" :perPage="perPage" :currentPage="currentPage"
        @page-change="(p) => currentPage = p">
        <template #actions="{ row }">

        </template>
    </commonTable>
</template>