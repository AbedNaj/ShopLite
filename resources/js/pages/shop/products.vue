<script setup>
import axios from '@/axios';
import { ref, onMounted, watch } from 'vue';
import ProductCard from '@/components/shop/ProductCard.vue';
import CategorySidebar from '@/components/shop/products/CategorySide.vue';
import Filters from '@/components/shop/products/Filters.vue';
const categories = ref([]);
const subCategories = ref([]);
const selectedCategory = ref();
const selectedCategoryName = ref();

const filter = ref({
    items: 12,
    min: '',
    max: null,
    subCategory: null,
    name: '',
    sort: 'newest'
});

const products = ref([]);


async function fetchSubCategoryData() {
    const res = await axios.get('/shop/subCategories', {

        params: {
            category: selectedCategory.value
        }
    });
    if (selectedCategory.value) {

        subCategories.value = res.data.data;

    } else {
        subCategories.value = [];
    };



}
async function fetchCategoryData() {
    const res = await axios.get('/shop/categories');

    categories.value = res.data.data;

};

const fetchProducts = async (page = 1) => {
    const res = await axios.get('/shop/products', {
        params: {
            category: selectedCategory.value,
            subcategory: filter.value.subCategory,
            item: filter.value.items,
            min_price: filter.value.min,
            max_price: filter.value.max,
            name: filter.value.name,
            sort: filter.value.sort,
            page: page
        }
    });

    products.value = res.data;
};

const goToPageByLink = (url) => {
    const pageMatch = url?.match(/page=(\d+)/);
    if (pageMatch) {
        fetchProducts(Number(pageMatch[1]));
    }
}
onMounted(() => {
    fetchCategoryData();
    fetchProducts();
    fetchSubCategoryData();
});


watch(selectedCategory, () => {
    fetchProducts()
    fetchSubCategoryData()
})

watch(filter, () => fetchProducts(), { deep: true });

</script>

<template>




    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">



            <CategorySidebar :categories="categories" v-model:selectedCategory="selectedCategory"
                v-model:selectedCategoryName="selectedCategoryName" />


            <main class="flex-1 min-w-0">



                <div class="mb-6" v-if="subCategories.length !== 0">
                    <div class="flex items-center gap-3 mb-4">
                        <h2 class="text-2xl font-bold text-foreground">{{ selectedCategoryName }}</h2>
                    </div>

                    <div class="flex flex-wrap gap-3 mb-6">

                        <button @click="filter.subCategory = null"
                            :class="filter.subCategory == null
                                ? 'px-4 py-2 bg-primary hover:cursor-pointer text-primary-foreground rounded-full font-medium hover:opacity-90 transition-opacity'
                                : 'px-4 py-2 bg-muted hover:cursor-pointer text-foreground rounded-full font-medium hover:bg-primary hover:text-primary-foreground transition-colors'">
                            All
                        </button>


                        <button v-for="data in subCategories" :key="data.id" @click="filter.subCategory = data.id"
                            :class="filter.subCategory == data.id
                                ? 'px-4 py-2 hover:cursor-pointer bg-primary text-primary-foreground rounded-full font-medium hover:opacity-90 transition-opacity'
                                : 'px-4 py-2 hover:cursor-pointer bg-muted text-foreground rounded-full font-medium hover:bg-primary hover:text-primary-foreground transition-colors'">
                            {{ data.name }}
                        </button>
                    </div>
                </div>




                <Filters v-model:filter="filter" />




                <div class="flex items-center justify-between mb-6">
                    <p class="text-muted-foreground">Showing {{ products.current_page }}-{{ products.last_page }}
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-muted-foreground">Items per page:</span>
                        <select v-model="filter.items"
                            class="px-2 py-1 border border-border rounded bg-background text-foreground text-sm">

                            <option>12</option>
                            <option>24</option>
                            <option>48</option>
                            <option>96</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1  sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    <template v-if="products.data?.length">
                        <div v-for="data in products.data" :key="data.id"
                            class="group bg-card border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <ProductCard :data="data" />
                        </div>
                    </template>

                    <div v-else class="col-span-full text-center py-16 bg-muted/30 rounded-xl shadow-inner">
                        <i class="pi pi-box text-5xl text-muted-foreground mb-4"></i>
                        <p class="text-xl font-semibold text-muted-foreground">No products found</p>
                        <p class="text-sm text-muted-foreground/80">Try adjusting your filters or search keywords.</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-2 mt-8" v-if="products.links">



                    <template v-for="(link, index) in products.links" :key="index">
                        <button v-if="link.url" v-html="link.label" @click="goToPageByLink(link.url)"
                            :class="link.active
                                ? 'px-3 py-2 bg-primary text-primary-foreground rounded-lg'
                                : 'px-3 py-2 border border-border rounded-lg hover:bg-muted/50 transition-colors'"></button>
                        <span v-else class="px-2 text-muted-foreground" v-html="link.label"></span>
                    </template>


                </div>


            </main>
        </div>
    </div>
</template>


<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>