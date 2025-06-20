<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'

// البيانات (data)
const activeNav = ref('Home')
const mobileMenuOpen = ref(false)
const searchOpen = ref(false)
const searchQuery = ref('')
const cartCount = ref(3)
const newsletterEmail = ref('')

// العناصر (navs, links)
const navItems = [
    { name: 'Home', icon: 'pi-home' },
    { name: 'Products', icon: 'pi-box' },
    { name: 'Categories', icon: 'pi-list' },
    { name: 'About', icon: 'pi-info-circle' },
    { name: 'Contact', icon: 'pi-envelope' }
]

const quickLinks = [
    { name: 'New Arrivals', icon: 'pi-star' },
    { name: 'Best Sellers', icon: 'pi-heart' },
    { name: 'Sale Items', icon: 'pi-tag' },
    { name: 'Gift Cards', icon: 'pi-gift' }
]

const supportLinks = [
    { name: 'Help Center', icon: 'pi-question-circle' },
    { name: 'Track Order', icon: 'pi-map-marker' },
    { name: 'Returns', icon: 'pi-refresh' },
    { name: 'Contact Us', icon: 'pi-phone' }
]

const socialLinks = [
    { name: 'Facebook', icon: 'pi-facebook' },
    { name: 'Twitter', icon: 'pi-twitter' },
    { name: 'Instagram', icon: 'pi-instagram' },
    { name: 'LinkedIn', icon: 'pi-linkedin' }
]


const currentYear = computed(() => new Date().getFullYear())


function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value
}

function toggleSearch() {
    searchOpen.value = !searchOpen.value
    if (searchOpen.value) {
        nextTick(() => {
            const input = document.querySelector('input[type="text"]') as HTMLInputElement
            if (input) input.focus()
        })
    }
}

function toggleCart() {
    console.log('Cart clicked')
}

function performSearch() {
    if (searchQuery.value.trim()) {
        console.log('Searching for:', searchQuery.value)
        searchOpen.value = false
    }
}

function isValidEmail(email: string) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function subscribeNewsletter() {
    if (newsletterEmail.value && isValidEmail(newsletterEmail.value)) {
        console.log('Newsletter subscription:', newsletterEmail.value)
        newsletterEmail.value = ''
    }
}

// mounted
onMounted(() => {
    document.addEventListener('click', (e) => {
        const target = e.target as HTMLElement
        if (!document.body.contains(target)) {
            mobileMenuOpen.value = false
            searchOpen.value = false
        }
    })
})
</script>


<template>
    <div class="flex flex-col min-h-screen bg-gradient-to-br from-background via-card to-background">

        <header class="sticky top-0 z-50 backdrop-blur-md bg-card/80 border-b border-border/50 shadow-sm">
            <div class="container mx-auto flex items-center justify-between px-4 py-4">

                <div class="flex items-center space-x-2">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center">
                        <i class="pi pi-shopping-bag text-primary-foreground text-sm"></i>
                    </div>
                    <h1
                        class="text-2xl font-bold tracking-tight bg-gradient-to-r from-foreground to-muted-foreground bg-clip-text text-transparent">
                        ShopLite
                    </h1>
                </div>

                <nav class="space-x-8 hidden md:flex">
                    <a v-for="item in navItems" :key="item.name" href="#"
                        class="relative text-muted-foreground hover:text-primary transition-all duration-300 group font-medium"
                        @click.prevent="activeNav = item.name">
                        {{ item.name }}
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-accent transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </nav>


                <div class="flex items-center space-x-4">
                    <button @click="toggleSearch" aria-label="Search"
                        class="relative p-2 rounded-full hover:bg-primary/10 transition-all duration-300 transform hover:scale-105">
                        <i class="pi pi-search text-primary text-xl"></i>
                    </button>

                    <button @click="toggleCart" aria-label="Cart"
                        class="relative p-2 rounded-full hover:bg-primary/10 transition-all duration-300 transform hover:scale-105">
                        <i class="pi pi-shopping-cart text-primary text-xl"></i>
                        <span v-if="cartCount > 0"
                            class="absolute -top-1 -right-1 bg-gradient-to-r from-destructive to-destructive text-destructive-foreground text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                            {{ cartCount }}
                        </span>
                    </button>


                    <button @click="toggleMobileMenu"
                        class="md:hidden p-2 rounded-full hover:bg-primary/10 transition-all duration-300"
                        aria-label="Menu">
                        <i :class="mobileMenuOpen ? 'pi pi-times' : 'pi pi-bars'" class="text-primary text-xl"></i>
                    </button>
                </div>
            </div>

            <div v-if="mobileMenuOpen" class="md:hidden border-t border-border/50 bg-card/95 backdrop-blur-sm">
                <nav class="container mx-auto px-4 py-4 space-y-2">
                    <a v-for="item in navItems" :key="item.name" href="#"
                        class="block py-2 px-4 text-muted-foreground hover:text-primary hover:bg-primary/5 rounded-lg transition-all duration-300"
                        @click.prevent="activeNav = item.name; mobileMenuOpen = false">
                        {{ item.name }}
                    </a>
                </nav>
            </div>
            <div v-if="searchOpen"
                class="absolute top-full left-0 right-0 bg-card/95 backdrop-blur-sm border-b border-border/50 shadow-lg">
                <div class="container mx-auto px-4 py-4">
                    <div class="relative max-w-md mx-auto">
                        <input v-model="searchQuery" type="text" placeholder="Search products..."
                            class="w-full pl-10 pr-4 py-3 rounded-full border border-border bg-background/50 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-ring focus:border-primary transition-all duration-300 text-foreground placeholder:text-muted-foreground"
                            @keyup.enter="performSearch">
                        <i
                            class="pi pi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground"></i>
                    </div>
                </div>
            </div>
        </header>


        <main class="container flex-1 mx-auto px-4 py-8">
            <slot />
            <router-view />
        </main>

        <footer class="bg-gradient-to-r from-card to-background border-t border-border/50 mt-16">
            <div class="container mx-auto px-4 py-12 text-foreground">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">


                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div
                                class="w-6 h-6 bg-gradient-to-br from-primary to-accent rounded-md flex items-center justify-center">
                                <i class="pi pi-shopping-bag text-primary-foreground text-xs"></i>
                            </div>
                            <h2 class="font-bold text-lg tracking-wide text-foreground">ShopLite</h2>
                        </div>
                        <p class="text-muted-foreground text-sm leading-relaxed">
                            Your trusted partner for quality products and exceptional shopping experiences.
                        </p>
                        <div class="flex space-x-3">
                            <button v-for="social in socialLinks" :key="social.name"
                                class="w-8 h-8 rounded-full bg-primary/10 hover:bg-primary/20 flex items-center justify-center transition-all duration-300 transform hover:scale-110"
                                :aria-label="social.name">
                                <i :class="social.icon" class="pi text-primary text-sm"></i>
                            </button>
                        </div>
                    </div>


                    <div class="space-y-4">
                        <h3 class="font-semibold text-sm uppercase tracking-wide text-muted-foreground">Quick Links</h3>
                        <ul class="space-y-2">
                            <li v-for="link in quickLinks" :key="link.name">
                                <a href="#"
                                    class="text-muted-foreground hover:text-primary transition-colors duration-300 text-sm flex items-center space-x-2 group">
                                    <i :class="link.icon"
                                        class="pi text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                                    <span>{{ link.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>


                    <div class="space-y-4">
                        <h3 class="font-semibold text-sm uppercase tracking-wide text-muted-foreground">Support</h3>
                        <ul class="space-y-2">
                            <li v-for="support in supportLinks" :key="support.name">
                                <a href="#"
                                    class="text-muted-foreground hover:text-primary transition-colors duration-300 text-sm flex items-center space-x-2 group">
                                    <i :class="support.icon"
                                        class="pi text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                                    <span>{{ support.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>


                    <div class="space-y-4">
                        <h3 class="font-semibold text-sm uppercase tracking-wide text-muted-foreground">Stay Updated
                        </h3>
                        <p class="text-muted-foreground text-sm">Subscribe to get special offers and updates.</p>
                        <div class="flex">
                            <input v-model="newsletterEmail" type="email" placeholder="Enter email"
                                class="flex-1 px-3 py-2 text-sm rounded-l-lg border border-border bg-background/50 focus:outline-none focus:ring-1 focus:ring-ring focus:border-primary transition-all duration-300 text-foreground placeholder:text-muted-foreground">
                            <button @click="subscribeNewsletter"
                                class="px-4 py-2 bg-gradient-to-r from-primary to-accent text-primary-foreground text-sm rounded-r-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <i class="pi pi-send text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-border/30">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                        <p class="text-sm text-muted-foreground">
                            &copy; {{ currentYear }} ShopLite. All rights reserved.
                        </p>
                        <div class="flex space-x-6 text-sm text-muted-foreground">
                            <a href="#" class="hover:text-primary transition-colors duration-300">Privacy Policy</a>
                            <a href="#" class="hover:text-primary transition-colors duration-300">Terms of Service</a>
                            <a href="#" class="hover:text-primary transition-colors duration-300">Cookies</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>