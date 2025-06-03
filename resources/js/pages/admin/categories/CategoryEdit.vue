<script setup>
import { ref, onMounted } from 'vue';
import DefaultHeader from '@/components/admin/default-header.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import TextArea from '@/components/ui/textarea/Textarea.vue';
import Select from '@/components/ui/select/Select.vue';
import { CategoryStatusMap } from '@/enums/appEnums';
import { useRouter } from 'vue-router';
import axios from '@/axios';
import { useToast } from 'vue-toastification'
const toast = useToast({ position: 'bottom-right' })
const router = useRouter();

const form = ref({
    name: '',
    description: '',
    image: null,
    is_active: true,
});

const errors = ref({});
const loading = ref(false);
const imagePreview = ref(null);
const handleImageChange = (event) => {
    form.value.image = event.target.files[0];
};
function fetchCategory() {
    const categoryId = router.currentRoute.value.params.id;
    axios.get(`admin/categories/${categoryId}`)
        .then(response => {
            const category = response.data.data;
            form.value.name = category.name;
            form.value.description = category.description || '';
            form.value.image = null;
            form.value.is_active = category.is_active;
            imagePreview.value = category.image;
        })
        .catch(error => {
            console.error('Error fetching category ' + error);
        });
}

const submit = async () => {
    loading.value = true;
    errors.value = {};

    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('description', form.value.description);
    formData.append('is_active', form.value.is_active ? 1 : 0);

    if (form.value.image) {
        formData.append('image', form.value.image);
    }


    formData.append('_method', 'PUT');

    try {
        await axios.post(`/admin/categories/${categoryId.value}`, formData);
        toast.success('Category updated successfully');

    } catch (err) {
        if (err.response?.status === 422) {
            errors.value = err.response.data.errors;
        }
    } finally {
        loading.value = false;
    }
};


const categoryId = ref(null);

onMounted(() => {
    categoryId.value = router.currentRoute.value.params.id;

    if (categoryId) {
        fetchCategory();
    }
});
</script>

<template>
    <DefaultHeader title="Create Edit" description="Edit Current Category." />

    <div class="bg-surface p-6 rounded-xl shadow-sm max-w-2xl mx-auto">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Name </label>
                <Input v-model="form.name" label="Name" placeholder="Enter category name" />
                <p class="text-sm mt-1 text-red-500" v-if="errors.name">{{ errors.name?.[0] }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description (optional) </label>
                <TextArea v-model="form.description" label="Description" placeholder="Enter description (optional)" />
                <p class="text-sm mt-1 text-red-500" v-if="errors.description">{{ errors.description?.[0] }}</p>
            </div>


            <div>
                <label class="block text-sm font-medium mb-1">Image (optional)</label>
                <input type="file" @change="handleImageChange" />
                <p v-if="errors.image" class="text-red-500 text-sm mt-1">{{ errors.image[0] }}</p>

                <img v-if="imagePreview" :src="imagePreview" class="mt-2 w-32 h-32 object-cover rounded" />
            </div>

            <div class="pt-4">
                <Button :disabled="loading" @click="submit">
                    {{ loading ? 'Saving...' : 'Save' }}
                </Button>
            </div>
        </div>
    </div>
</template>
