<template>
    <div class="dashboard-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-skywave-text">Recent Activity</h3>
            <button class="text-sm text-skywave-primary hover:text-skywave-accent focus:outline-none">
                View All
            </button>
        </div>

        <div class="space-y-4">

            <div class="flex items-start">
                <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-skywave-text">New order placed</p>
                    <p class="text-xs text-gray-500">Order #12345 was created</p>
                    <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                </div>
            </div>


            <div class="flex items-start">
                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-skywave-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-skywave-text">New customer signed up</p>
                    <p class="text-xs text-gray-500">Jane Smith created an account</p>
                    <p class="text-xs text-gray-400 mt-1">45 minutes ago</p>
                </div>
            </div>


            <div class="flex items-start">
                <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-skywave-text">Payment failed</p>
                    <p class="text-xs text-gray-500">Order #12340 payment declined</p>
                    <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                </div>
            </div>
        </div>
    </div>
</template>