<script setup lang="ts">
import { ref } from 'vue'

defineProps<{
    isOpen: boolean
}>()

const navigation = ref([
    { name: 'Dashboard', icon: 'HomeIcon', current: true, path: '/dashboard' },
    { name: 'Analytics', icon: 'ChartBarIcon', current: false, path: '/analytics' },
    { name: 'Customers', icon: 'UserGroupIcon', current: false, path: '/customers' },
    { name: 'Products', icon: 'ShoppingBagIcon', current: false, path: '/products' },
    { name: 'Orders', icon: 'ShoppingCartIcon', current: false, path: '/orders' },
    { name: 'Settings', icon: 'CogIcon', current: false, path: '/settings' },
])
</script>

<template>
    <aside :class="[
        'fixed inset-y-0 left-0 z-10 bg-skywave-surface shadow-md transition-width overflow-hidden border-r border-skywave-border',
        isOpen ? 'w-64' : 'w-16'
    ]">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-skywave-border">
            <span v-if="isOpen" class="text-xl font-semibold text-skywave-primary">SkyAdmin</span>
            <span v-else class="text-xl font-semibold text-skywave-primary">S</span>
        </div>

        <!-- Navigation -->
        <nav class="mt-4 space-y-1 px-2">
            <a v-for="item in navigation" :key="item.name" :href="item.path" :class="[
                'sidebar-link',
                item.current ? 'active' : 'text-skywave-secondary hover:text-skywave-primary'
            ]">
                <!-- Icon placeholder -->
                <div class="w-5 h-5 mr-3 flex items-center justify-center text-current">
                    <svg v-if="item.icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path v-if="item.icon === 'HomeIcon'" stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        <path v-else-if="item.icon === 'ChartBarIcon'" stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        <path v-else-if="item.icon === 'UserGroupIcon'" stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        <path v-else-if="item.icon === 'ShoppingBagIcon'" stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        <path v-else-if="item.icon === 'ShoppingCartIcon'" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        <path v-else-if="item.icon === 'CogIcon'" stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span :class="isOpen ? 'opacity-100' : 'opacity-0'">{{ item.name }}</span>
            </a>
        </nav>

        <!-- User Profile Section -->
        <div class="absolute bottom-0 w-full p-4 border-t border-skywave-border" v-if="isOpen">
            <div class="flex items-center">
                <div class="h-9 w-9 rounded-full bg-skywave-accent flex items-center justify-center text-white">
                    <span class="text-sm font-medium">JD</span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">John Doe</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 w-full p-4 border-t border-skywave-border flex justify-center" v-else>
            <div class="h-9 w-9 rounded-full bg-skywave-accent flex items-center justify-center text-white">
                <span class="text-sm font-medium">JD</span>
            </div>
        </div>
    </aside>
</template>