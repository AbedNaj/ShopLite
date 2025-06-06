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


const toast = useToast({ position: 'bottom-right' })

const router = useRouter();

const form = ref({
    name: '',
    category_id: '',
    image: null,

});
const imagePreview = ref(null);
const errors = ref({});
const loading = ref(false);

const handleImageChange = (event) => {
    form.value.image = event.target.files[0];


};
const categories = ref([]);


async function fetchCategoryData() {
    const res = await axios.get('/admin/categories/actions/for-select');
    categories.value = res.data.data;
}
const subCategoryID = ref(null);
function fetchSubCategory() {
    subCategoryID.value = router.currentRoute.value.params.id;

    axios.get(`admin/subCategories/${subCategoryID.value}`).then(response => {

        const subCategory = response.data.data;

        form.value.name = subCategory.name;

        form.value.category_id = subCategory.category.id;

        imagePreview.value = subCategory.image;
    }).catch(error => {
        console.error('Error fetching category ');
    });
}
const submit = async () => {
    loading.value = true;
    errors.value = {};

    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('category_id', form.value.category_id);
    if (form.value.image) {
        formData.append('image', form.value.image);
    }
    formData.append('_method', 'PUT');

    try {
        await axios.post(`/admin/subCategories/${subCategoryID.value}`, formData);

        toast.success('SubCategory Updated successfully');
    } catch (err) {

        if (err.response?.status === 422) {

            errors.value = err.response.data.errors;

        }
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchCategoryData()
    fetchSubCategory()
}) 
</script>

<template>


    <DefaultHeader title="SubCategory Edit" description="Add a new product SubCategory." />

    <div class="bg-surface p-6 rounded-xl shadow-sm max-w-2xl mx-auto">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Name </label>
                <Input v-model="form.name" label="Name" placeholder="Enter category name" />
                <p class="text-sm mt-1 text-red-500" v-if="errors.name">{{ errors.name?.[0] }}</p>
            </div>

            <div>
                <Select v-model="form.category_id">
                    <SelectTrigger>
                        <SelectValue placeholder="Select a Category" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Categories</SelectLabel>

                            <SelectItem v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <p class="text-sm mt-1 text-red-500" v-if="errors.sub_category">{{ errors.sub_category?.[0] }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Image (optional)</label>
                <input type="file" @change="handleImageChange" />
                <p v-if="errors.image" class="text-red-500 text-sm mt-1">{{ errors.image[0] }}</p>


                <img v-if="imagePreview" :src="imagePreview" class="mt-2 w-32 h-32 object-cover rounded" />
            </div>

            <div class="pt-4">
                <Button :disabled="loading" @click="submit">
                    {{ loading ? 'Saving...' : 'Updated Category' }}
                </Button>
            </div>
        </div>
    </div>
</template>