<script setup>
const BellIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const SearchIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const UserIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const ChevronDownIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const MenuIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
</script>

<template>
    <header class="h-16 flex items-center justify-between px-6" :style="{
        backgroundColor: 'var(--color-surface)',
        borderBottom: '1px solid var(--color-border)'
    }">

        <div class="flex items-center space-x-4">

            <button class="p-2 rounded-lg hover:bg-[var(--color-muted)] lg:hidden transition-colors duration-200">
                <MenuIcon :style="{ color: 'var(--color-foreground)' }" />
            </button>


            <div class="relative">
                <SearchIcon class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4"
                    :style="{ color: 'var(--color-muted-foreground)' }" />
                <input type="text" placeholder="Search..."
                    class="pl-10 pr-4 py-2 w-80 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[var(--color-ring)] transition-all duration-200"
                    :style="{
                        borderColor: 'var(--color-border)',
                        backgroundColor: 'var(--color-surface)',
                        color: 'var(--color-foreground)'
                    }" />
            </div>
        </div>


        <div class="flex items-center space-x-4">
            <!-- Notification Icon -->
            <button class="relative p-2 rounded-lg hover:bg-[var(--color-muted)] transition-colors duration-200">
                <BellIcon :style="{ color: 'var(--color-muted-foreground)' }" />
                <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full"
                    :style="{ backgroundColor: 'var(--color-primary)' }">
                    <span class="w-2 h-2 rounded-full bg-white block m-auto mt-[2px]"></span>
                </span>
            </button>


            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center"
                    :style="{ backgroundColor: 'var(--color-accent)' }">
                    <UserIcon class="h-4 w-4 text-white" />
                </div>
                <div class="flex items-center space-x-1">
                    <span class="text-sm font-medium" :style="{ color: 'var(--color-foreground)' }">
                        Admin User
                    </span>
                    <ChevronDownIcon :style="{ color: 'var(--color-muted-foreground)' }" />
                </div>
            </div>
        </div>
    </header>
</template>
