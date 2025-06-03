<script setup>
defineProps({
    title: {
        type: String,
        default: 'Default Title'
    },
    description: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <section class="border-b border-border pb-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-foreground">{{ title }}</h1>
                <p v-if="description" class="mt-2 text-sm text-muted-foreground">
                    {{ description }}
                </p>
            </div>

            <div>
                <slot />
            </div>
        </div>
    </section>
</template>