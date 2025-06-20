<script setup>

const props = defineProps({
    data: {
        type: [Object, Array],
        required: true
    }
})

</script>

<template>
    <div
        class="group bg-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-border">

        <div class="relative overflow-hidden rounded-t-2xl">
            <img :src="data.thumbnail" :alt="data.name"
                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500" />

            <div class="absolute top-4 left-4">

            </div>

            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button @click="quickView(data)"
                    class="w-10 h-10 bg-card/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-card transition-all duration-300 border border-border">
                    <i class="pi pi-eye text-foreground"></i>
                </button>
            </div>
        </div>


        <div class="p-6">
            <h3
                class="font-semibold text-lg text-card-foreground mb-3 group-hover:text-primary transition-colors duration-300">
                {{ data.name }}
            </h3>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-primary">
                        ${{ data.price_after_discount }}
                    </span>
                    <span v-if="data.discount_price > 0" class="text-sm line-through text-red-500">
                        ${{ data.price }}
                    </span>
                </div>
                <button @click="addToCart(data)"
                    class="bg-gradient-to-r from-primary to-accent text-primary-foreground px-4 py-2 rounded-full hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="pi pi-shopping-cart"></i>
                </button>
            </div>

        </div>
    </div>
</template>