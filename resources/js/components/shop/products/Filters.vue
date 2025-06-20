<script setup>
import { defineProps, defineEmits, reactive, watch } from 'vue';

const props = defineProps({
    filter: [Object, Array],
});

const emit = defineEmits(['update:filter']);


const localFilter = reactive({ ...props.filter });


watch(
    () => localFilter,
    (val) => {
        emit('update:filter', val)

    },
    { deep: true }
);


const sortOptions = [
    { key: 'newest', label: 'Newest First' },
    { key: 'lowToHigh', label: 'Price: Low to High' },
    { key: 'highToLow', label: 'Price: High to Low' },
    { key: 'discounted', label: 'Discounted' }
];
</script>

<template>
    <div class="bg-card border border-border rounded-xl p-6 mb-8 shadow-sm space-y-6">


        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div class="flex-1 max-w-md">
                <div class="relative">
                    <i
                        class="pi pi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground"></i>
                    <input type="text" v-model="localFilter.name" placeholder="Search in Electronics..."
                        class="w-full pl-10 pr-4 py-3 border border-border rounded-lg bg-background text-foreground focus:ring-2 focus:ring-primary/20 focus:border-primary" />
                </div>
            </div>


            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-muted-foreground">Sort by:</span>
                    <select v-model="localFilter.sort"
                        class="px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option :value="sort.key" v-for="sort in sortOptions" :key="sort.key">
                            {{ sort.label }}
                        </option>

                    </select>
                </div>


            </div>
        </div>


        <div>
            <h3 class="text-sm font-semibold text-foreground mb-3 flex items-center">
                <i class="pi pi-dollar mr-2 text-chart-1"></i>
                Price Range
            </h3>
            <div class="flex items-center gap-3">
                <input type="number" v-model="localFilter.min" placeholder="Min"
                    class="flex-1 px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm" />
                <span class="text-muted-foreground text-sm">-</span>
                <input type="number" v-model="localFilter.max" placeholder="Max"
                    class="flex-1 px-3 py-2 border border-border rounded-lg bg-background text-foreground focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm" />
            </div>
        </div>
    </div>
</template>
