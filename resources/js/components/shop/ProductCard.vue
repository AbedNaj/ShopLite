<script setup>

const props = defineProps({

    data: {
        type: [Object, Array],
        required: true
    }

});

</script>


<template>



    <div class="relative aspect-square bg-muted/30 overflow-hidden">
        <div class="absolute top-3 left-3 z-10">

        </div>
        <div class="absolute top-3 right-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
            <button
                class="w-8 h-8 bg-background/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-background transition-colors">
                <i class="pi pi-heart text-sm"></i>
            </button>
        </div>
        <div class="w-full h-full bg-gradient-to-br from-muted/50 to-muted/30 flex items-center justify-center">
            <div class="w-auto h-auto min-w-full object-cover bg-muted rounded-lg flex items-center justify-center">
                <img :src="data.thumbnail">
            </div>
        </div>
        <div
            class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
            <div class="flex gap-2">
                <button
                    class="flex-1 bg-primary text-primary-foreground py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                    Quick View
                </button>
                <button
                    class="px-3 py-2 bg-background/80 backdrop-blur-sm rounded-lg hover:bg-background transition-colors">
                    <i class="pi pi-shopping-cart text-sm"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="p-4">
        <h3 class="font-semibold text-foreground mb-2 line-clamp-2 group-hover:text-primary transition-colors">
            {{ data.name }}
        </h3>
        <p class="text-sm text-muted-foreground mb-3 line-clamp-2">
            {{ data.description }}
        </p>
        <div v-if="data.rating" class="flex items-center gap-1 mb-3">
            <div class="flex text-yellow-400">
                <i class="pi pi-star-fill text-xs"></i>
                <i class="pi pi-star-fill text-xs"></i>
                <i class="pi pi-star-fill text-xs"></i>
                <i class="pi pi-star-fill text-xs"></i>
                <i class="pi pi-star text-xs"></i>
            </div>
            <span class="text-xs text-muted-foreground ml-1">(128)</span>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-lg font-bold text-foreground">${{ data.price_after_discount }}</span>
                <span v-if="data.discount_price > 0" class="text-sm text-red-500 line-through"> ${{
                    data.price }}</span>
            </div>
            <button
                class="w-8 h-8 bg-primary text-primary-foreground rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                <i class="pi pi-plus text-sm"></i>
            </button>
        </div>
    </div>


</template>