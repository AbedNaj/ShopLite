<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { ref, onMounted } from 'vue';


const currentSlide = ref(0);
const featuredProducts = ref([]);
const categories = ref([]);
const testimonials = ref([]);
const currentTestimonial = ref(0);


const heroSlides = ref([
    {
        id: 1,
        title: "Summer Collection",
        subtitle: "Discover the latest trends",
        description: "Up to 50% off on selected items",
        image: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=600&fit=crop",
        cta: "Shop Now",
        gradient: "from-blue-600 to-purple-600"
    },
    {
        id: 2,
        title: "Tech Essentials",
        subtitle: "Innovation at your fingertips",
        description: "Latest gadgets and electronics",
        image: "https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=1200&h=600&fit=crop",
        cta: "Explore Tech",
        gradient: "from-purple-600 to-pink-600"
    },
    {
        id: 3,
        title: "Home & Living",
        subtitle: "Transform your space",
        description: "Stylish furniture and decor",
        image: "https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&h=600&fit=crop",
        cta: "Shop Home",
        gradient: "from-green-600 to-blue-600"
    }
]);

// Sample data
onMounted(() => {
    // Auto-slide hero carousel
    setInterval(() => {
        currentSlide.value = (currentSlide.value + 1) % heroSlides.value.length;
    }, 5000);

    // Auto-rotate testimonials
    setInterval(() => {
        currentTestimonial.value = (currentTestimonial.value + 1) % 3;
    }, 4000);

    // Initialize sample data
    initializeData();
});

const initializeData = () => {
    featuredProducts.value = [
        {
            id: 1,
            name: "Premium Wireless Headphones",
            price: 299,
            originalPrice: 399,
            image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop",
            rating: 4.8,
            badge: "Best Seller"
        },
        {
            id: 2,
            name: "Smart Fitness Watch",
            price: 199,
            originalPrice: 249,
            image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=400&fit=crop",
            rating: 4.6,
            badge: "New"
        },
        {
            id: 3,
            name: "Minimalist Backpack",
            price: 89,
            originalPrice: 120,
            image: "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=400&fit=crop",
            rating: 4.7,
            badge: "Sale"
        },
        {
            id: 4,
            name: "Organic Skincare Set",
            price: 159,
            originalPrice: 199,
            image: "https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400&h=400&fit=crop",
            rating: 4.9,
            badge: "Limited"
        }
    ];

    categories.value = [
        {
            name: "Electronics",
            icon: "pi-mobile",
            count: "2,340 items",
            image: "https://images.unsplash.com/photo-1498049794561-7780e7231661?w=300&h=200&fit=crop",
            color: "from-blue-500 to-cyan-500"
        },
        {
            name: "Fashion",
            icon: "pi-heart",
            count: "5,680 items",
            image: "https://images.unsplash.com/photo-1445205170230-053b83016050?w=300&h=200&fit=crop",
            color: "from-pink-500 to-rose-500"
        },
        {
            name: "Home & Garden",
            icon: "pi-home",
            count: "1,920 items",
            image: "https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=300&h=200&fit=crop",
            color: "from-green-500 to-emerald-500"
        },
        {
            name: "Sports",
            icon: "pi-star",
            count: "890 items",
            image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=300&h=200&fit=crop",
            color: "from-orange-500 to-red-500"
        },
        {
            name: "Books",
            icon: "pi-book",
            count: "3,450 items",
            image: "https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=200&fit=crop",
            color: "from-purple-500 to-indigo-500"
        },
        {
            name: "Beauty",
            icon: "pi-star-fill",
            count: "1,230 items",
            image: "https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=300&h=200&fit=crop",
            color: "from-yellow-500 to-orange-500"
        }
    ];

    testimonials.value = [
        {
            name: "Sarah Johnson",
            role: "Verified Buyer",
            content: "Amazing quality products and super fast delivery. ShopLite has become my go-to online store!",
            rating: 5,
            avatar: "https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop"
        },
        {
            name: "Mike Chen",
            role: "Regular Customer",
            content: "Great customer service and competitive prices. I've recommended ShopLite to all my friends.",
            rating: 5,
            avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop"
        },
        {
            name: "Emma Wilson",
            role: "Premium Member",
            content: "The variety of products is incredible, and the shopping experience is always smooth and enjoyable.",
            rating: 5,
            avatar: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop"
        }
    ];
};

const goToSlide = (index) => {
    currentSlide.value = index;
};

const addToCart = (product) => {
    console.log('Added to cart:', product.name);
    // Implement add to cart logic
};

const quickView = (product) => {
    console.log('Quick view:', product.name);
    // Implement quick view modal
};
</script>

<template>
    <DefaultLayout>
        <!-- Hero Section with Carousel -->
        <section class="relative h-[600px] overflow-hidden bg-gradient-to-br from-bg via-surface to-bg">
            <div class="relative h-full">
                <div v-for="(slide, index) in heroSlides" :key="slide.id" :class="[
                    'absolute inset-0 transition-all duration-1000 transform',
                    currentSlide === index ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full'
                ]">
                    <div class="relative h-full bg-cover bg-center" :style="`background-image: url('${slide.image}')`">
                        <div :class="`absolute inset-0 bg-gradient-to-r ${slide.gradient} opacity-80`"></div>
                        <div class="relative container mx-auto px-4 h-full flex items-center">
                            <div class="max-w-2xl text-white">
                                <h1 class="text-5xl md:text-7xl font-bold mb-4 leading-tight animate-fade-in-up">
                                    {{ slide.title }}
                                </h1>
                                <p class="text-xl md:text-2xl mb-2 opacity-90 animate-fade-in-up"
                                    style="animation-delay: 0.2s;">
                                    {{ slide.subtitle }}
                                </p>
                                <p class="text-lg mb-8 opacity-80 animate-fade-in-up" style="animation-delay: 0.4s;">
                                    {{ slide.description }}
                                </p>
                                <button
                                    class="bg-white text-gray-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg animate-fade-in-up"
                                    style="animation-delay: 0.6s;">
                                    {{ slide.cta }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel indicators -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
                <button v-for="(slide, index) in heroSlides" :key="index" @click="goToSlide(index)" :class="[
                    'w-3 h-3 rounded-full transition-all duration-300',
                    currentSlide === index ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75'
                ]"></button>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-surface/50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
                            <i class="pi pi-truck text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg text-text mb-2">Free Shipping</h3>
                        <p class="text-secondary text-sm">On orders over $100</p>
                    </div>
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
                            <i class="pi pi-shield text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg text-text mb-2">Secure Payment</h3>
                        <p class="text-secondary text-sm">100% secure transactions</p>
                    </div>
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
                            <i class="pi pi-refresh text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg text-text mb-2">Easy Returns</h3>
                        <p class="text-secondary text-sm">30-day return policy</p>
                    </div>
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
                            <i class="pi pi-headphones text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg text-text mb-2">24/7 Support</h3>
                        <p class="text-secondary text-sm">Always here to help</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-20 bg-bg">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-text mb-4">Shop by Category</h2>
                    <p class="text-xl text-secondary max-w-2xl mx-auto">
                        Discover our wide range of products across multiple categories
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="category in categories" :key="category.name"
                        class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
                        <div class="relative h-64 bg-cover bg-center"
                            :style="`background-image: url('${category.image}')`">
                            <div
                                :class="`absolute inset-0 bg-gradient-to-t ${category.color} opacity-80 group-hover:opacity-90 transition-opacity duration-300`">
                            </div>
                            <div class="relative h-full flex flex-col justify-end p-6 text-white">
                                <div class="flex items-center mb-2">
                                    <i :class="`pi ${category.icon} text-2xl mr-3`"></i>
                                    <h3 class="text-2xl font-bold">{{ category.name }}</h3>
                                </div>
                                <p class="text-white/90 mb-4">{{ category.count }}</p>
                                <button
                                    class="self-start bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium hover:bg-white/30 transition-all duration-300">
                                    Explore →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section class="py-20 bg-surface/30">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-text mb-4">Featured Products</h2>
                    <p class="text-xl text-secondary max-w-2xl mx-auto">
                        Hand-picked products just for you
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div v-for="product in featuredProducts" :key="product.id"
                        class="group bg-bg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <img :src="product.image" :alt="product.name"
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span :class="[
                                    'px-3 py-1 rounded-full text-xs font-medium text-white',
                                    product.badge === 'Best Seller' ? 'bg-gradient-to-r from-yellow-500 to-orange-500' :
                                        product.badge === 'New' ? 'bg-gradient-to-r from-green-500 to-emerald-500' :
                                            product.badge === 'Sale' ? 'bg-gradient-to-r from-red-500 to-pink-500' :
                                                'bg-gradient-to-r from-purple-500 to-indigo-500'
                                ]">
                                    {{ product.badge }}
                                </span>
                            </div>
                            <div
                                class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button @click="quickView(product)"
                                    class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-all duration-300">
                                    <i class="pi pi-eye text-gray-700"></i>
                                </button>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    <i v-for="n in 5" :key="n" :class="[
                                        'pi text-sm',
                                        n <= Math.floor(product.rating) ? 'pi-star-fill' : 'pi-star'
                                    ]"></i>
                                </div>
                                <span class="text-sm text-secondary ml-2">({{ product.rating }})</span>
                            </div>

                            <h3
                                class="font-semibold text-lg text-text mb-3 group-hover:text-primary transition-colors duration-300">
                                {{ product.name }}
                            </h3>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl font-bold text-primary">${{ product.price }}</span>
                                    <span class="text-sm text-secondary line-through">${{ product.originalPrice
                                    }}</span>
                                </div>
                                <button @click="addToCart(product)"
                                    class="bg-gradient-to-r from-primary to-accent text-white px-4 py-2 rounded-full hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                    <i class="pi pi-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <button
                        class="bg-transparent border-2 border-primary text-primary px-8 py-3 rounded-full font-semibold hover:bg-primary hover:text-white transition-all duration-300 transform hover:scale-105">
                        View All Products
                    </button>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-20 bg-gradient-to-r from-primary to-accent">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-4xl font-bold text-white mb-4">Stay in the Loop</h2>
                    <p class="text-xl text-white/90 mb-8">
                        Subscribe to our newsletter and be the first to know about new products, exclusive deals, and
                        special offers.
                    </p>

                    <div class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" placeholder="Enter your email address"
                            class="flex-1 px-6 py-4 rounded-full border-0 focus:outline-none focus:ring-4 focus:ring-white/30 text-gray-900">
                        <button
                            class="bg-white text-primary px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Subscribe Now
                        </button>
                    </div>

                    <p class="text-white/70 text-sm mt-4">
                        No spam, unsubscribe at any time.
                    </p>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 bg-bg">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-text mb-4">What Our Customers Say</h2>
                    <p class="text-xl text-secondary max-w-2xl mx-auto">
                        Don't just take our word for it - hear from our happy customers
                    </p>
                </div>

                <div class="relative max-w-4xl mx-auto">
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-in-out"
                            :style="`transform: translateX(-${currentTestimonial * 100}%)`">
                            <div v-for="(testimonial, index) in testimonials" :key="index"
                                class="w-full flex-shrink-0 px-8">
                                <div class="bg-surface/50 rounded-3xl p-8 text-center backdrop-blur-sm">
                                    <div class="flex justify-center mb-4">
                                        <div class="flex text-yellow-400 text-xl">
                                            <i v-for="n in testimonial.rating" :key="n" class="pi pi-star-fill"></i>
                                        </div>
                                    </div>
                                    <p class="text-xl text-text mb-6 italic leading-relaxed">
                                        "{{ testimonial.content }}"
                                    </p>
                                    <div class="flex items-center justify-center">
                                        <img :src="testimonial.avatar" :alt="testimonial.name"
                                            class="w-16 h-16 rounded-full object-cover mr-4">
                                        <div class="text-left">
                                            <h4 class="font-semibold text-text">{{ testimonial.name }}</h4>
                                            <p class="text-secondary text-sm">{{ testimonial.role }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial indicators -->
                    <div class="flex justify-center mt-8 space-x-3">
                        <button v-for="(testimonial, index) in testimonials" :key="index"
                            @click="currentTestimonial = index" :class="[
                                'w-3 h-3 rounded-full transition-all duration-300',
                                currentTestimonial === index ? 'bg-primary scale-125' : 'bg-border hover:bg-primary/50'
                            ]"></button>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
