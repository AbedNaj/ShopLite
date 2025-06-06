<script setup>
import { ref, onMounted } from 'vue';
import DefaultHeader from '@/components/admin/default-header.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import TextArea from '@/components/ui/textarea/Textarea.vue';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import { useRouter } from 'vue-router';
import axios from '@/axios';
import { useToast } from 'vue-toastification'
import { ToastAction } from 'reka-ui';


const toast = useToast({ position: 'bottom-right' })

const router = useRouter();

const form = ref({
    name: '',
    description: '',
    price: 0,
    discount_price: 0,
    stock: 0,
    sub_category_id: '',
    images: [],
    thumbnail: null,
});

const errors = ref({});
const loading = ref(false);

const handleImageChange = (event) => {
    form.value.images = Array.from(event.target.files);
};

const handleThumbnailChange = (event) => {
    form.value.thumbnail = event.target.files[0];
}
const categories = ref([]);

async function fetchCategoryData() {
    const res = await axios.get('/admin/subCategories/actions/for-select');
    categories.value = res.data.data;
}


const submit = async () => {
    loading.value = true;
    errors.value = {};

    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('description', form.value.description);
    formData.append('sub_category_id', form.value.sub_category_id);
    formData.append('price', form.value.price);
    formData.append('stock', form.value.stock);
    formData.append('discount_price', form.value.discount_price);
    formData.append('thumbnail', form.value.thumbnail);

    form.value.images.forEach((image, index) => {
        formData.append(`images[${index}]`, image);
    });

    try {
        await axios.post('/admin/products', formData);
        router.push({ name: 'admin.products.index' });
        toast.success('Product created successfully');
    } catch (err) {

        if (err.response?.status === 422) {
            errors.value = err.response.data.errors;
            console.error(errors.value);
        }
    } finally {
        loading.value = false;
    }
};


onMounted(fetchCategoryData); 
</script>

<template>


    <DefaultHeader title="Product Create" description="Add a new product." />

    <div class="bg-surface p-6 rounded-xl shadow-sm max-w-2xl mx-auto">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Name </label>
                <Input v-model="form.name" label="Name" placeholder="Enter Product name" />
                <p class="text-sm mt-1 text-red-500" v-if="errors.name">{{ errors.name?.[0] }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description (Optional) </label>
                <TextArea v-model="form.description" placeholder="Enter Product Description" />
                <p class="text-sm mt-1 text-red-500" v-if="errors.description">{{ errors.description?.[0] }}</p>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Price </label>
                    <Input v-model="form.price" type="number" min="0" placeholder="Enter Product Price"
                        class="w-full" />
                    <p class="text-sm mt-1 text-red-500" v-if="errors.price">{{ errors.price?.[0] }}</p>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Discount Price (Optional) </label>
                    <Input v-model="form.discount_price" type="number" min="0" placeholder="Enter Product Discount"
                        class="w-full" />
                    <p class="text-sm mt-1 text-red-500" v-if="errors.discount_price">{{ errors.discount_price?.[0] }}
                    </p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Stock </label>
                <Input v-model="form.stock" type="number" min="0" placeholder="Enter Product Stock" />
                <p class="text-sm mt-1 text-red-500" v-if="errors.stock">{{ errors.stock?.[0] }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">SubCategory </label>
                <Select v-model="form.sub_category_id">
                    <SelectTrigger>
                        <SelectValue placeholder="Select Product Cateogry" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>SubCategories</SelectLabel>

                            <SelectItem v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <p class="text-sm mt-1 text-red-500" v-if="errors.sub_category_id">{{ errors.sub_category_id?.[0] }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Thumbnail</label>
                <input type="file" @change="handleThumbnailChange" />
                <p v-if="errors.thumbnail" class="text-red-500 text-sm mt-1">{{ errors.thumbnail[0] }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Product Images (optional)</label>
                <input type="file" @change="handleImageChange" multiple />
                <p v-if="errors.image" class="text-red-500 text-sm mt-1">{{ errors.image[0] }}</p>
            </div>

            <div class="pt-4">
                <Button :disabled="loading" @click="submit">
                    {{ loading ? 'Saving...' : 'Create Category' }}
                </Button>
            </div>
        </div>
    </div>
</template>