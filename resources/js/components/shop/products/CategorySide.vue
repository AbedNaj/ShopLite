<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    categories: Array,
    selectedCategory: [String, Number, null],
    selectedCategoryName: String,
});

const emit = defineEmits(['update:selectedCategory', 'update:selectedCategoryName']);

function handleCategorySelect(category) {
    emit('update:selectedCategory', category?.id ?? null);
    emit('update:selectedCategoryName', category?.name ?? null);
}
</script>

<template>
    <aside class="lg:w-80 flex-shrink-0">
        <div class="space-y-6">
            <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
                <h3 class="text-xl font-bold text-foreground mb-6 flex items-center">
                    <i class="pi pi-th-large mr-3 text-primary text-xl"></i>
                    Categories
                </h3>

                <div @click="handleCategorySelect(null)"
                    :class="selectedCategory == null
                        ? 'my-2 p-4 rounded-xl bg-primary text-primary-foreground cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg'
                        : 'my-2 p-4 rounded-xl border-2 border-border hover:border-primary hover:bg-muted/30 cursor-pointer transition-all duration-200'">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-lg">All Categories</span>
                    </div>
                </div>

                <div v-for="category in categories" :key="category.id" class="space-y-4">
                    <div @click="handleCategorySelect(category)"
                        :class="selectedCategory == category.id
                            ? 'my-2 p-4 rounded-xl bg-primary text-primary-foreground cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg'
                            : 'my-2 p-4 rounded-xl border-2 border-border hover:border-primary hover:bg-muted/30 cursor-pointer transition-all duration-200'">
                        <span class="font-semibold text-lg">{{ category.name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>