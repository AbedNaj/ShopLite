<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
</script>

<template>
    <div class="fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-300 ease-in-out" :style="{
        backgroundColor: 'var(--color-sidebar)',
        color: 'var(--color-sidebar-foreground)',
        borderRight: '1px solid var(--color-sidebar-border)',
    }">

        <div class="flex h-16 items-center justify-center px-6"
            :style="{ borderBottom: '1px solid var(--color-sidebar-border)' }">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                    :style="{ backgroundColor: 'var(--color-sidebar-primary)' }">
                    <span class="font-bold text-sm" :style="{ color: 'var(--color-sidebar-primary-foreground)' }">
                        S
                    </span>
                </div>
                <span class="text-xl font-bold" :style="{ color: 'var(--color-sidebar-foreground)' }">
                    ShopLite
                </span>
            </div>
        </div>


        <nav class="mt-6 px-3">
            <div class="space-y-1">
                <router-link :to="{ name: 'admin.dashboard' }"
                    class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                    :style="{
                        backgroundColor: route.name === 'admin.dashboard'
                            ? 'var(--color-sidebar-primary)'
                            : 'transparent',
                        color: route.name === 'admin.dashboard'
                            ? 'var(--color-sidebar-primary-foreground)'
                            : 'var(--color-sidebar-foreground)'
                    }">
                    <i class="pi pi-home mr-3 text-base"></i>
                    Dashboard
                </router-link>

                <router-link :to="{ name: 'admin.categories' }"
                    class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                    :style="{
                        backgroundColor: route.path.startsWith('/admin/categories') || route.path.startsWith('/admin/category')
                            ? 'var(--color-sidebar-primary)'
                            : 'transparent',
                        color: route.path.startsWith('/admin/categories') || route.path.startsWith('/admin/category')
                            ? 'var(--color-sidebar-primary-foreground)'
                            : 'var(--color-sidebar-foreground)'
                    }">
                    <i class="pi pi-tags mr-3 text-base"></i>
                    Categories
                </router-link>

                <router-link :to="{ name: 'admin.subCategory.index' }"
                    class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                    :style="{
                        backgroundColor: route.path.startsWith('/admin/sub-category')
                            ? 'var(--color-sidebar-primary)'
                            : 'transparent',
                        color: route.path.startsWith('/admin/sub-category')
                            ? 'var(--color-sidebar-primary-foreground)'
                            : 'var(--color-sidebar-foreground)'
                    }">
                    <i class="pi pi-sitemap mr-3 text-base"></i>
                    Sub Categories
                </router-link>

            </div>
        </nav>
    </div>
</template>
