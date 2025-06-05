<script setup>
import { computed } from 'vue'
import { ref } from 'vue'
import Button from '@/components/ui/button/Button.vue'
import { useRouter } from 'vue-router'
import axios from '@/axios'
import { useToast } from 'vue-toastification'
const toast = useToast({ position: 'bottom-right' })
const router = useRouter()
const showModal = ref(false)
const pendingDeleteId = ref(null)
const deleting = ref(false)
function askDelete(id) {
    pendingDeleteId.value = id
    showModal.value = true
}
function cancelDelete() {
    showModal.value = false
}


async function confirmDelete() {
    await deleteRow(pendingDeleteId.value)
    showModal.value = false
}

async function deleteRow(id) {
    deleting.value = true;
    await axios.delete(`${props.deleteEndPoint}/${id}`)
        .then(() => {
            emit('refresh-data')
            toast.warning('Category has been deleted.');
        })
        .catch(error => {
            toast.error('Failed to delete category');
        }).finally(() => {
            deleting.value = false;
        });



}

function resolveNestedKey(obj, key) {
    return key.split('.').reduce((o, i) => (o ? o[i] : ''), obj);
}
const props = defineProps({

    data: Array,
    columns: Array,
    total: Number,
    editRoute: {
        type: String,
        default: 'admin.dashboard'
    },
    deleteEndPoint: {
        type: String,
        default: 'admin.dashboard'
    },
    perPage: {
        type: Number,
        default: 10,
    },
    currentPage: {
        type: Number,
        default: 1,
    },
    enumMaps: { type: Object, default: () => ({}) }
})

const emit = defineEmits(['page-change'])




function goToPage(page) {
    if (page >= 1 && page <= props.total) {
        emit('page-change', page)
    }
}
</script>

<template>

    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm text-center space-y-4">
            <h2 class="text-lg font-semibold">Confirm Deletion</h2>
            <p>Are you sure you want to delete this item?</p>
            <div class="flex justify-center space-x-4">
                <Button @click="confirmDelete" :disabled="deleting" class="px-4 py-2 bg-red-600 text-white rounded">
                    {{ deleting ? 'Deleting...' : 'Yes, Delete' }}

                </Button>
                <Button @click="cancelDelete" class="px-4 py-2 bg-gray-300 rounded">Cancel</Button>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="overflow-x-auto border border-border rounded-lg bg-card">
            <table class="w-full">
                <thead class="bg-muted">
                    <tr>
                        <th v-for="column in columns" :key="column.key"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-muted-foreground">
                            {{ column.label }}
                        </th>
                        <th v-if="$slots.actions"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-muted-foreground">
                            ACTIONS
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    <tr v-for="row in data" :key="row.id">
                        <td v-for="column in columns" :key="column.key"
                            class="px-6 py-4 whitespace-nowrap text-sm text-card-foreground">
                            <template v-if="props.enumMaps[column.key]">
                                <span class="px-2 py-1 text-xs font-medium rounded-full" :class="{
                                    'bg-green-100 text-green-700': props.enumMaps[column.key][row[column.key]]?.color === 'green',
                                    'bg-red-100 text-red-700': props.enumMaps[column.key][row[column.key]]?.color === 'red',
                                    'bg-yellow-100 text-yellow-700': props.enumMaps[column.key][row[column.key]]?.color === 'yellow',

                                }">
                                    {{ props.enumMaps[column.key][row[column.key]]?.label || 'Unknown' }}
                                </span>
                            </template>
                            <template v-else>
                                {{ resolveNestedKey(row, column.key) }}
                            </template>
                        </td>

                        <td v-if="$slots.actions" class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <router-link :to="{ name: editRoute, params: { id: row.id } }"
                                class="text-primary hover:cursor-pointer hover:underline">Edit</router-link>
                            <button @click="askDelete(row.id)"
                                class="text-destructive ml-2 hover:cursor-pointer hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="data.length === 0">
                        <td :colspan="columns.length + ($slots.actions ? 1 : 0)"
                            class="text-center py-6 text-muted-foreground text-sm">
                            No data available
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-center space-x-2">
            <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                class="px-3 py-1 text-sm rounded-md border bg-muted text-muted-foreground hover:bg-muted/50 disabled:opacity-50">
                Previous
            </button>

            <span class="text-sm text-muted-foreground">Page {{ currentPage }} From {{ total }}</span>

            <button @click="goToPage(currentPage + 1)" :disabled="currentPage === total"
                class="px-3 py-1 text-sm rounded-md border bg-muted text-muted-foreground hover:bg-muted/50 disabled:opacity-50">
                Next
            </button>
        </div>
    </div>
</template>