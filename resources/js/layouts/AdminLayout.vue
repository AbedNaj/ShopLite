<script setup>

import { ref, computed, onMounted } from 'vue'
import Sidebar from '@/components/admin/Sidebar.vue'
import Header from '@/components/admin/Header.vue'
</script>


<template>
    <div class="min-h-screen" :style="{ backgroundColor: 'var(--color-bg)' }">

        <Sidebar />


        <div class="ml-64 flex flex-col min-h-screen">
            <Header></Header>

            <main class="flex-1 p-6">

                <router-view />

            </main>
        </div>
    </div>
</template>
<style></style>