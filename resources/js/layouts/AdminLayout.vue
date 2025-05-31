<script setup>
// Icon components (you'll need to import these from your icon library)
// For example, if using Heroicons or Lucide Vue:
// import { 
//   HomeIcon, 
//   UsersIcon, 
//   ChartBarIcon as BarChart3Icon,
//   BellIcon,
//   MagnifyingGlassIcon as SearchIcon,
//   UserIcon,
//   ChevronDownIcon,
//   Bars3Icon as MenuIcon,
//   EnvelopeIcon as MailIcon,
//   CalendarIcon,
//   DocumentTextIcon as FileTextIcon,
//   CogIcon as SettingsIcon,
//   TrendingUpIcon,
//   CurrencyDollarIcon as DollarSignIcon,
//   ShoppingCartIcon,
//   ActivityIcon
// } from '@heroicons/vue/24/outline'

// Or create placeholder components for now:
const HomeIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const UsersIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const BarChart3Icon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const BellIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const SearchIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const UserIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const ChevronDownIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const MenuIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const MailIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const CalendarIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const FileTextIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const SettingsIcon = { template: '<div class="w-5 h-5 border rounded"></div>' }
const TrendingUpIcon = { template: '<div class="w-4 h-4 border rounded"></div>' }
const DollarSignIcon = { template: '<div class="w-6 h-6 border rounded"></div>' }
const ShoppingCartIcon = { template: '<div class="w-6 h-6 border rounded"></div>' }
const ActivityIcon = { template: '<div class="w-6 h-6 border rounded"></div>' }
</script>

<style>
:root {
    --color-bg: #F9FAFC;
    --color-surface: #FFFFFF;
    --color-primary: #3B82F6;
    --color-secondary: #1E293B;
    --color-text: #0F172A;
    --color-accent: #60A5FA;
    --color-border: #E2E8F0;
}

input:focus {
    --tw-ring-color: var(--color-primary);
}
</style>
<template>
    <div class="min-h-screen" :style="{ backgroundColor: 'var(--color-bg)' }">

        <div class="fixed inset-y-0 left-0 z-50 w-64 transform transition-transform duration-300 ease-in-out"
            :style="{ backgroundColor: 'var(--color-surface)', borderRight: '1px solid var(--color-border)' }">

            <div class="flex h-16 items-center justify-center px-6"
                :style="{ borderBottom: '1px solid var(--color-border)' }">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                        :style="{ backgroundColor: 'var(--color-primary)' }">
                        <span class="text-white font-bold text-sm">S</span>
                    </div>
                    <span class="text-xl font-bold" :style="{ color: 'var(--color-text)' }">SkyWave</span>
                </div>
            </div>


            <nav class="mt-6 px-3">
                <div class="space-y-1">

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
                        :style="{ backgroundColor: 'var(--color-primary)', color: 'white' }">
                        <HomeIcon class="mr-3 h-5 w-5" />
                        Dashboard
                    </a>

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 hover:bg-gray-50"
                        :style="{ color: 'var(--color-secondary)' }">
                        <UsersIcon class="mr-3 h-5 w-5" />
                        Users
                    </a>

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 hover:bg-gray-50"
                        :style="{ color: 'var(--color-secondary)' }">
                        <BarChart3Icon class="mr-3 h-5 w-5" />
                        Analytics
                    </a>

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 hover:bg-gray-50"
                        :style="{ color: 'var(--color-secondary)' }">
                        <MailIcon class="mr-3 h-5 w-5" />
                        Messages
                    </a>

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 hover:bg-gray-50"
                        :style="{ color: 'var(--color-secondary)' }">
                        <CalendarIcon class="mr-3 h-5 w-5" />
                        Calendar
                    </a>

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 hover:bg-gray-50"
                        :style="{ color: 'var(--color-secondary)' }">
                        <FileTextIcon class="mr-3 h-5 w-5" />
                        Reports
                    </a>

                    <a href="#"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 hover:bg-gray-50"
                        :style="{ color: 'var(--color-secondary)' }">
                        <SettingsIcon class="mr-3 h-5 w-5" />
                        Settings
                    </a>
                </div>
            </nav>
        </div>


        <div class="ml-64 flex flex-col min-h-screen">


            <header class="h-16 flex items-center justify-between px-6"
                :style="{ backgroundColor: 'var(--color-surface)', borderBottom: '1px solid var(--color-border)' }">


                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-lg hover:bg-gray-100 lg:hidden">
                        <MenuIcon class="h-5 w-5" :style="{ color: 'var(--color-text)' }" />
                    </button>

                    <div class="relative">
                        <SearchIcon class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4"
                            :style="{ color: 'var(--color-secondary)' }" />
                        <input type="text" placeholder="Search..."
                            class="pl-10 pr-4 py-2 w-80 rounded-lg border focus:outline-none focus:ring-2 transition-all duration-200"
                            :style="{
                                borderColor: 'var(--color-border)',
                                backgroundColor: 'var(--color-surface)',
                                color: 'var(--color-text)'
                            }" />
                    </div>
                </div>


                <div class="flex items-center space-x-4">
                    <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <BellIcon class="h-5 w-5" :style="{ color: 'var(--color-secondary)' }" />
                        <span
                            class="absolute -top-1 -right-1 w-3 h-3 rounded-full text-xs flex items-center justify-center"
                            :style="{ backgroundColor: 'var(--color-primary)' }">
                            <span class="w-2 h-2 rounded-full bg-white"></span>
                        </span>
                    </button>

                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center"
                            :style="{ backgroundColor: 'var(--color-accent)' }">
                            <UserIcon class="h-4 w-4 text-white" />
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-sm font-medium" :style="{ color: 'var(--color-text)' }">Admin User</span>
                            <ChevronDownIcon class="h-4 w-4" :style="{ color: 'var(--color-secondary)' }" />
                        </div>
                    </div>
                </div>
            </header>


            <main class="flex-1 p-6">


                <div class="mb-8">
                    <h1 class="text-3xl font-bold" :style="{ color: 'var(--color-text)' }">Dashboard</h1>
                    <p class="mt-2 text-sm" :style="{ color: 'var(--color-secondary)' }">Welcome back! Here's what's
                        happening with your business today.</p>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="p-6 rounded-xl shadow-sm"
                        :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium" :style="{ color: 'var(--color-secondary)' }">Total
                                    Revenue</p>
                                <p class="text-2xl font-bold mt-2" :style="{ color: 'var(--color-text)' }">$45,231.89
                                </p>
                                <p class="text-xs mt-1" :style="{ color: 'var(--color-accent)' }">+20.1% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" :style="{ backgroundColor: 'var(--color-bg)' }">
                                <DollarSignIcon class="h-6 w-6" :style="{ color: 'var(--color-primary)' }" />
                            </div>
                        </div>
                    </div>

                    <div class="p-6 rounded-xl shadow-sm"
                        :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium" :style="{ color: 'var(--color-secondary)' }">Total Users
                                </p>
                                <p class="text-2xl font-bold mt-2" :style="{ color: 'var(--color-text)' }">2,350</p>
                                <p class="text-xs mt-1" :style="{ color: 'var(--color-accent)' }">+5.4% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" :style="{ backgroundColor: 'var(--color-bg)' }">
                                <UsersIcon class="h-6 w-6" :style="{ color: 'var(--color-primary)' }" />
                            </div>
                        </div>
                    </div>

                    <div class="p-6 rounded-xl shadow-sm"
                        :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium" :style="{ color: 'var(--color-secondary)' }">Total Orders
                                </p>
                                <p class="text-2xl font-bold mt-2" :style="{ color: 'var(--color-text)' }">12,234</p>
                                <p class="text-xs mt-1" :style="{ color: 'var(--color-accent)' }">+12.5% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" :style="{ backgroundColor: 'var(--color-bg)' }">
                                <ShoppingCartIcon class="h-6 w-6" :style="{ color: 'var(--color-primary)' }" />
                            </div>
                        </div>
                    </div>

                    <div class="p-6 rounded-xl shadow-sm"
                        :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium" :style="{ color: 'var(--color-secondary)' }">Active Now
                                </p>
                                <p class="text-2xl font-bold mt-2" :style="{ color: 'var(--color-text)' }">573</p>
                                <p class="text-xs mt-1" :style="{ color: 'var(--color-accent)' }">+8.2% from last hour
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" :style="{ backgroundColor: 'var(--color-bg)' }">
                                <ActivityIcon class="h-6 w-6" :style="{ color: 'var(--color-primary)' }" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                    <!-- Chart Card 1 -->
                    <div class="p-6 rounded-xl shadow-sm"
                        :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold" :style="{ color: 'var(--color-text)' }">Revenue Overview
                            </h3>
                            <div class="flex items-center space-x-2">
                                <TrendingUpIcon class="h-4 w-4" :style="{ color: 'var(--color-accent)' }" />
                                <span class="text-sm" :style="{ color: 'var(--color-accent)' }">+12.5%</span>
                            </div>
                        </div>
                        <div class="h-64 flex items-center justify-center rounded-lg"
                            :style="{ backgroundColor: 'var(--color-bg)' }">
                            <span class="text-sm" :style="{ color: 'var(--color-secondary)' }">Chart Component
                                Here</span>
                        </div>
                    </div>

                    <!-- Chart Card 2 -->
                    <div class="p-6 rounded-xl shadow-sm"
                        :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold" :style="{ color: 'var(--color-text)' }">User Activity</h3>
                            <div class="flex items-center space-x-2">
                                <ActivityIcon class="h-4 w-4" :style="{ color: 'var(--color-accent)' }" />
                                <span class="text-sm" :style="{ color: 'var(--color-accent)' }">Live</span>
                            </div>
                        </div>
                        <div class="h-64 flex items-center justify-center rounded-lg"
                            :style="{ backgroundColor: 'var(--color-bg)' }">
                            <span class="text-sm" :style="{ color: 'var(--color-secondary)' }">Chart Component
                                Here</span>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="rounded-xl shadow-sm"
                    :style="{ backgroundColor: 'var(--color-surface)', border: '1px solid var(--color-border)' }">
                    <div class="p-6 border-b" :style="{ borderColor: 'var(--color-border)' }">
                        <h3 class="text-lg font-semibold" :style="{ color: 'var(--color-text)' }">Recent Orders</h3>
                    </div>
                    <div class="overflow-hidden">
                        <table class="w-full">
                            <thead :style="{ backgroundColor: 'var(--color-bg)' }">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        :style="{ color: 'var(--color-secondary)' }">
                                        Order ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        :style="{ color: 'var(--color-secondary)' }">
                                        Customer
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        :style="{ color: 'var(--color-secondary)' }">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"
                                        :style="{ color: 'var(--color-secondary)' }">
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" :style="{ divideColor: 'var(--color-border)' }">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                        :style="{ color: 'var(--color-text)' }">
                                        #1001
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm"
                                        :style="{ color: 'var(--color-secondary)' }">
                                        John Doe
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full"
                                            :style="{ backgroundColor: 'var(--color-accent)', color: 'white' }">
                                            Completed
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                        :style="{ color: 'var(--color-text)' }">
                                        $299.00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>
</template>
