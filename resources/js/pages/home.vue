<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { ref, onMounted } from 'vue';
import axios from '@/axios';

import ProductSection from '@/components/shop/HomeSection.vue';



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

]);

const currentSlide = ref(0);
const featuredProducts = ref([]);
const categories = ref([]);
const recentProducts = ref([]);
const discountProducts = ref([]);
const currentTestimonial = ref(0);

const scrollContainer = ref(null)
const offset = ref(0);
const limit = ref(8);



const scrollRight = () => {

    scrollContainer.value.scrollBy({ left: 300, behavior: 'smooth' })
    offset.value += limit.value

    loadMoreCategories()
}

const scrollLeft = () => {
    scrollContainer.value.scrollBy({ left: -300, behavior: 'smooth' })

}


const fetchCategoryData = async () => {
    try {
        const res = await axios.get(`/shop/home/categories`, {
            params: { offset: offset.value, limit: limit.value }
        });
        categories.value.push(...res.data.data)
    } catch (error) {
        console.error('Something went wrong.');
    }
};


const fetchRecentProductData = async () => {
    try {
        const res = await axios.get(`/shop/home/recentProducts`);

        recentProducts.value.push(...res.data.data)

        console.log(recentProducts.value)
    } catch (error) {
        console.error('Something went wrong.');
    }
};

const fetchDsicountProductData = async () => {
    try {
        const res = await axios.get(`/shop/home/discountProducts`);

        discountProducts.value.push(...res.data.data)

        console.log(discountProducts.value)
    } catch (error) {
        console.error('Something went wrong.');
    }
};
const loadMoreCategories = async () => {

    try {
        const res = await axios.get('/shop/home/categories', {
            params: { offset: offset.value, limit: limit.value }
        })
        categories.value.push(...res.data.data)
    } catch (err) {
        console.log(err)
    }
}


const goToSlide = (index) => {
    currentSlide.value = index;
};

const addToCart = (product) => {
    console.log('Added to cart:', product.name);

};


const quickView = (product) => {
    console.log('Quick view:', product.name);

};

onMounted(() => {

    setInterval(() => {
        currentSlide.value = (currentSlide.value + 1) % heroSlides.value.length;
    }, 5000);

    setInterval(() => {
        currentTestimonial.value = (currentTestimonial.value + 1) % 3;
    }, 4000);


    fetchCategoryData();
    fetchRecentProductData();
    fetchDsicountProductData();
});

</script>

<template>
    <DefaultLayout>

        <section class="relative h-[600px] overflow-hidden bg-gradient-to-br from-background via-card to-background">
            <div class="relative h-full">
                <div v-for="(slide, index) in heroSlides" :key="slide.id" :class="[
                    'absolute inset-0 transition-all duration-1000 transform',
                    currentSlide === index ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full'
                ]">
                    <div class="relative h-full bg-cover bg-center" :style="`background-image: url('${slide.image}')`">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary to-accent opacity-80"></div>
                        <div class="relative container mx-auto px-4 h-full flex items-center">
                            <div class="max-w-2xl text-primary-foreground">
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
                                    class="bg-primary-foreground text-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-secondary transition-all duration-300 transform hover:scale-105 shadow-lg animate-fade-in-up"
                                    style="animation-delay: 0.6s;">
                                    {{ slide.cta }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
                <button v-for="(slide, index) in heroSlides" :key="index" @click="goToSlide(index)" :class="[
                    'w-3 h-3 rounded-full transition-all duration-300',
                    currentSlide === index ? 'bg-primary-foreground scale-125' : 'bg-primary-foreground/50 hover:bg-primary-foreground/75'
                ]"></button>
            </div>
        </section>


        <section class="py-16 bg-muted/50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center group" v-for="feature in [
                        { icon: 'pi-truck', title: 'Free Shipping', desc: 'On orders over $100' },
                        { icon: 'pi-shield', title: 'Secure Payment', desc: '100% secure transactions' },
                        { icon: 'pi-refresh', title: 'Easy Returns', desc: '30-day return policy' },
                        { icon: 'pi-headphones', title: '24/7 Support', desc: 'Always here to help' }
                    ]" :key="feature.icon">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
                            <i :class="`pi ${feature.icon} text-primary-foreground text-2xl`"></i>
                        </div>
                        <h3 class="font-semibold text-lg text-foreground mb-2">{{ feature.title }}</h3>
                        <p class="text-muted-foreground text-sm">{{ feature.desc }}</p>
                    </div>
                </div>
            </div>
        </section>


        <section class="py-20 bg-background">
            <div class="container  mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-foreground mb-4">Shop by Category</h2>
                    <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                        Discover our wide range of products across multiple categories
                    </p>
                </div>

                <div class="relative ">

                    <button @click="scrollLeft"
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
                        <i class="pi pi-chevron-left"></i>
                    </button>


                    <div ref="scrollContainer"
                        class="flex py-2 gap-8 overflow-x-auto scroll-smooth px-2 scrollbar-hide">

                        <div v-for="category in categories" :key="category.id"
                            class="group flex-none transition-transform duration-300 ease-in-out hover:scale-105 hover:cursor-pointer h-64 min-h-64 w-48 flex flex-col overflow-hidden rounded-2xl shadow-md bg-white text-center">


                            <div class="w-full h-48 bg-white flex items-center justify-center">
                                <img :src="category.image" :alt="category.name"
                                    class="max-h-full max-w-full object-contain" />
                            </div>


                            <div class="py-3 px-2">
                                <h3
                                    class="text-base font-semibold text-card-foreground group-hover:text-chart-1   transition-colors duration-300">
                                    {{ category.name }}
                                </h3>
                            </div>
                        </div>

                    </div>




                    <button @click="scrollRight"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow p-2 rounded-full">
                        <i class="pi pi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>



        <ProductSection title="Recent Products" subTitle=" Recent Added Products" :datas="recentProducts" />
        <ProductSection title="Discounted Products" subTitle="Grab the best deals before they're gone!"
            :datas="discountProducts" />





    </DefaultLayout>
</template>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;

    scrollbar-width: none;

}
</style>