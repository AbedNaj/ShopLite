<script setup>
import ProductCard from '@/components/shop/ProductCard.vue'
import ViewAllButton from '@/components/shop/ViewAllButton.vue'

const props = defineProps({
    title: {
        type: String,
        default: 'Section Title'
    },
    subTitle: {
        type: String,
        default: 'Section SubTitle'
    },
    buttonText: {
        type: String,
        default: 'View All'
    },
    datas: {
        type: [Array, Object],

    }
})
</script>

<template>
    <section class="py-20 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-foreground mb-4">{{ props.title }}</h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">

                    {{ props.subTitle }}

                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">

                <ProductCard v-for="data in props.datas" :key="data.id" :data="data" />
            </div>

            <div class="text-center mt-12">

                <ViewAllButton>
                    {{ props.buttonText }}
                </ViewAllButton>
            </div>
        </div>
    </section>
</template>