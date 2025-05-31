<script setup lang="ts">
defineProps<{
    isSidebarOpen: boolean
}>()

defineEmits<{
    (e: 'toggleSidebar'): void
}>()
</script>

<template>
    <header class="bg-skywave-surface shadow-sm z-10 border-b border-skywave-border">
        <div class="flex items-center justify-between h-16 px-4 md:px-6">
            <!-- Left side: Toggle button and breadcrumbs -->
            <div class="flex items-center">
                <!-- Sidebar toggle -->
                <button @click="$emit('toggleSidebar')"
                    class="text-skywave-secondary hover:text-skywave-primary focus:outline-none mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path v-if="isSidebarOpen" stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Breadcrumbs -->
                <div class="hidden md:flex items-center text-sm">
                    <a href="/dashboard" class="text-skywave-primary">Dashboard</a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 mx-2 text-skywave-border">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="text-skywave-text">Overview</span>
                </div>
            </div>

            <!-- Right side: Search, notifications, and profile -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div class="hidden md:block relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search..."
                        class="py-2 pl-10 pr-4 w-64 bg-skywave-bg border border-skywave-border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-skywave-primary/30" />
                </div>

                <!-- Notifications -->
                <button class="relative p-1 text-skywave-secondary hover:text-skywave-primary focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <span
                        class="absolute top-0 right-0 inline-flex items-center justify-center h-4 w-4 rounded-full bg-red-500 text-xs font-bold text-white">3</span>
                </button>

                <!-- Profile dropdown -->
                <div class="relative">
                    <button class="flex items-center focus:outline-none">
                        <div class="h-8 w-8 rounded-full bg-skywave-accent text-white flex items-center justify-center">
                            <span class="text-sm font-medium">JD</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 ml-1 text-skywave-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>