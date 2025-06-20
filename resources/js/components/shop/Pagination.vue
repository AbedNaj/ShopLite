<script setup></script>

<template>

    <div class="flex items-center justify-center gap-2">
        <button
            class="px-3 py-2 border border-border rounded-lg hover:bg-muted/50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="pi pi-chevron-left text-sm"></i>
        </button>
        <button class="px-3 py-2 bg-primary text-primary-foreground rounded-lg">1</button>
        <button class="px-3 py-2 border border-border rounded-lg hover:bg-muted/50 transition-colors">2</button>
        <button class="px-3 py-2 border border-border rounded-lg hover:bg-muted/50 transition-colors">3</button>
        <span class="px-2 text-muted-foreground">...</span>
        <button class="px-3 py-2 border border-border rounded-lg hover:bg-muted/50 transition-colors">25</button>
        <button class="px-3 py-2 border border-border rounded-lg hover:bg-muted/50 transition-colors">
            <i class="pi pi-chevron-right text-sm"></i>
        </button>
    </div>

</template>