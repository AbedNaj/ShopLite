<script setup>
import { useRouter } from 'vue-router'
</script>

<template>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-foreground">Dashboard</h1>
        <p class="mt-2 text-sm text-muted-foreground">Welcome back! Here's what's happening with your business today.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="p-6 rounded-xl shadow-sm bg-card border border-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Revenue</p>
                    <p class="text-2xl font-bold mt-2 text-card-foreground">$45,231.89</p>
                    <p class="text-xs mt-1 text-chart-1">+20.1% from last month</p>
                </div>
                <div class="p-3 rounded-lg bg-secondary">
                    <DollarSignIcon class="h-6 w-6 text-primary" />
                </div>
            </div>
        </div>

        <div class="p-6 rounded-xl shadow-sm bg-card border border-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Users</p>
                    <p class="text-2xl font-bold mt-2 text-card-foreground">2,350</p>
                    <p class="text-xs mt-1 text-chart-2">+5.4% from last month</p>
                </div>
                <div class="p-3 rounded-lg bg-secondary">
                    <UsersIcon class="h-6 w-6 text-primary" />
                </div>
            </div>
        </div>

        <div class="p-6 rounded-xl shadow-sm bg-card border border-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Orders</p>
                    <p class="text-2xl font-bold mt-2 text-card-foreground">12,234</p>
                    <p class="text-xs mt-1 text-chart-3">+12.5% from last month</p>
                </div>
                <div class="p-3 rounded-lg bg-secondary">
                    <ShoppingCartIcon class="h-6 w-6 text-primary" />
                </div>
            </div>
        </div>

        <div class="p-6 rounded-xl shadow-sm bg-card border border-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Active Now</p>
                    <p class="text-2xl font-bold mt-2 text-card-foreground">573</p>
                    <p class="text-xs mt-1 text-chart-4">+8.2% from last hour</p>
                </div>
                <div class="p-3 rounded-lg bg-secondary">
                    <ActivityIcon class="h-6 w-6 text-primary" />
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Chart Card 1 -->
        <div class="p-6 rounded-xl shadow-sm bg-card border border-border">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-card-foreground">Revenue Overview</h3>
                <div class="flex items-center space-x-2">
                    <TrendingUpIcon class="h-4 w-4 text-chart-1" />
                    <span class="text-sm text-chart-1">+12.5%</span>
                </div>
            </div>
            <div class="h-64 flex items-center justify-center rounded-lg bg-muted">
                <span class="text-sm text-muted-foreground">Chart Component Here</span>
            </div>
        </div>

        <!-- Chart Card 2 -->
        <div class="p-6 rounded-xl shadow-sm bg-card border border-border">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-card-foreground">User Activity</h3>
                <div class="flex items-center space-x-2">
                    <ActivityIcon class="h-4 w-4 text-chart-2" />
                    <span class="text-sm text-chart-2">Live</span>
                </div>
            </div>
            <div class="h-64 flex items-center justify-center rounded-lg bg-muted">
                <span class="text-sm text-muted-foreground">Chart Component Here</span>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="rounded-xl shadow-sm bg-card border border-border">
        <div class="p-6 border-b border-border">
            <h3 class="text-lg font-semibold text-card-foreground">Recent Orders</h3>
        </div>
        <div class="overflow-hidden">
            <table class="w-full">
                <thead class="bg-muted">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-muted-foreground">
                            Order ID
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-muted-foreground">
                            Customer
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-muted-foreground">
                            Status
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-muted-foreground">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-card-foreground">
                            #1001
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                            John Doe
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-chart-1 text-white">
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-card-foreground">
                            $299.00
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-card-foreground">
                            #1002
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                            Jane Smith
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-chart-2 text-white">
                                Processing
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-card-foreground">
                            $199.00
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-card-foreground">
                            #1003
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                            Mike Johnson
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-chart-3 text-white">
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-card-foreground">
                            $89.00
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>