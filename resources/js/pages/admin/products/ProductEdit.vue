<script setup>
import { ref, onMounted, watch } from 'vue';
import DefaultHeader from '@/components/admin/default-header.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import TextArea from '@/components/ui/textarea/Textarea.vue';
import { useRouter } from 'vue-router';
import axios from '@/axios';
import { useToast } from 'vue-toastification'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog'

import {
    Dialog,
    DialogTrigger,
    DialogContent,
} from '@/components/ui/dialog'

const previewImage = ref(null)

const toast = useToast({ position: 'bottom-right' })

const router = useRouter();
const ProductID = ref(null);
const subCategories = ref([]);
const thumbnail = ref();
const images = ref([]);
const categories = ref([]);

const form = ref({
    name: '',
    description: '',
    price: 0,
    discount_price: 0,
    stock: 0,
    sub_category_id: '',
    category_id: '',
    images: [],
    thumbnail: null,
});

const errors = ref({});
const loading = ref(false);


function openPreview(imageUrl) {
    previewImage.value = imageUrl
}






const handleImageChange = (event) => {
    form.value.images = Array.from(event.target.files);
};

const handleThumbnailChange = (event) => {
    form.value.thumbnail = event.target.files[0];
}

async function fetchProductData() {
    ProductID.value = router.currentRoute.value.params.id;
    await axios.get(`/admin/products/${ProductID.value}`).then(response => {

        const productData = response.data.data;
        thumbnail.value = productData.thumbnail

        images.value = productData.images.map(image => ({
            image_path: image.image_path,
            id: image.id
        }));

        form.value.name = productData.name

        form.value.description = productData.description

        form.value.category_id = productData.category_id;
        form.value.sub_category_id = productData.sub_category_id;

        form.value.discount_price = productData.discount_price;
        form.value.price = productData.price;
        form.value.stock = productData.stock;


    });



}

async function fetchSubCategoryData() {
    try {
        const res = await axios.get('/admin/subCategories/actions/for-select', {
            params: {

                category: form.value.category_id
            }
        });
        subCategories.value = res.data.data;

    }
    catch (err) {

    }
}
async function fetchCategoryData() {
    const res = await axios.get(`/admin/categories/actions/for-select/  `, {
        params: {

        }
    });
    categories.value = res.data.data;

}
async function removeImage(imageID) {
    try {
        await axios.delete(`/admin/productImages/${imageID}`)
        toast.success('image deleted successfully')
        images.value = images.value.filter(image => image.id !== imageID);

    } catch (error) {
        toast.error('something went wrong')
    }

}
const submit = async () => {
    loading.value = true;
    errors.value = {};

    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('description', form.value.description);
    formData.append('sub_category_id', form.value.sub_category_id);
    formData.append('category_id', form.value.category_id);
    formData.append('price', form.value.price);
    formData.append('stock', form.value.stock);
    formData.append('discount_price', form.value.discount_price);
    if (form.value.thumbnail instanceof File) {
        formData.append('thumbnail', form.value.thumbnail);
    }




    form.value.images.forEach((image, index) => {
        formData.append(`images[${index}]`, image);
    });
    formData.append('_method', 'PUT');
    try {
        const response = await axios.post(`/admin/products/${ProductID.value}`, formData);
        toast.success('Product updated successfully');
        form.value.thumbnail = null;
        form.value.images = [];

        images.value = response.data.data.images.map(img => ({
            id: img.id,
            image_path: img.image_path,
        }));
    } catch (err) {


        if (err.response?.status === 422) {
            errors.value = err.response.data.errors;
            console.error(errors.value);
        }
    } finally {
        loading.value = false;

    }
};




onMounted(() => {
    fetchCategoryData()
    fetchProductData()

});

watch(
    () => form.value.category_id,
    async (newVal, oldVal) => {
        if (!newVal) {
            subCategories.value = [];
            form.value.sub_category_id = '';
            return;
        }

        await fetchSubCategoryData();

        if (!form.value.sub_category_id) {
            form.value.sub_category_id = '';
        }
    }
);
</script>

<template>


    <DefaultHeader title="Product Edit" description="Edit Current Product" />

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
                <label class="block text-sm font-medium mb-1">Category </label>
                <Select v-model="form.category_id">
                    <SelectTrigger>
                        <SelectValue placeholder="Select Product Cateogry" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Categories</SelectLabel>

                            <SelectItem v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <p class="text-sm mt-1 text-red-500" v-if="errors.category_id">{{ errors.category_id?.[0] }}</p>
            </div>
            <div v-if="form.category_id">
                <label class="block text-sm font-medium mb-1">SubCategory </label>
                <Select v-model="form.sub_category_id">
                    <SelectTrigger>
                        <SelectValue placeholder="Select Product Cateogry" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>SubCategories</SelectLabel>

                            <SelectItem v-for="cat in subCategories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <p class="text-sm mt-1 text-red-500" v-if="errors.sub_category_id">{{ errors.sub_category_id?.[0] }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Thumbnail</label>
                <Input type="file" class="hover:cursor-pointer" @change="handleThumbnailChange" />
                <p v-if="errors.thumbnail" class="text-red-500 text-sm mt-1">{{ errors.thumbnail[0] }}</p>

                <Dialog>
                    <DialogTrigger as-child>
                        <img :src="thumbnail || image" alt="Product Image"
                            class="mt-2 w-32  h-32 object-cover transition-transform duration-200 hover:scale-105 rounded-lg overflow-hidden shadow-sm cursor-pointer"
                            @click="openPreview(thumbnail)" />
                    </DialogTrigger>

                    <DialogContent class="p-0 bg-transparent shadow-none border-none max-w-4xl">
                        <img :src="previewImage" class="w-full h-auto rounded-lg" />
                    </DialogContent>
                </Dialog>



            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Images (optional)</label>
                <Input type="file" @change="handleImageChange" multiple class="hover:cursor-pointer" />

                <p v-if="errors.image" class="text-red-500 text-sm mt-1">{{ errors.image[0] }}</p>

                <div v-if="images.length" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4">
                    <div v-for="(image, index) in images" :key="image.id"
                        class="relative group border border-gray-200 rounded-lg overflow-hidden shadow-sm">


                        <Dialog>
                            <DialogTrigger as-child>
                                <img loading="lazy" :src="image.image_path || image" alt="Product Image"
                                    class="w-full h-36 object-cover transition-transform duration-200 group-hover:scale-105 cursor-pointer"
                                    @click="openPreview(image.image_path || image)" />
                            </DialogTrigger>

                            <DialogContent class="p-0 bg-transparent shadow-none border-none max-w-4xl">
                                <img :src="previewImage" class="w-full h-auto rounded-lg" />
                            </DialogContent>
                        </Dialog>


                        <div class="absolute top-1 right-1">
                            <AlertDialog>
                                <AlertDialogTrigger
                                    class="bg-white bg-opacity-75 hover:cursor-pointer text-red-600 hover:text-red-800 rounded-full p-1 shadow-md transition">
                                    <i class="pi pi-trash text-base"></i>
                                </AlertDialogTrigger>

                                <AlertDialogContent>
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Delete this image?</AlertDialogTitle>
                                        <AlertDialogDescription>
                                            Are you sure you want to permanently delete this product image? This action
                                            cannot be undone.
                                        </AlertDialogDescription>
                                    </AlertDialogHeader>

                                    <AlertDialogFooter>
                                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                                        <AlertDialogAction @click="removeImage(image.id)">Yes, Delete
                                        </AlertDialogAction>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>
                        </div>

                    </div>
                </div>


            </div>



            <div class="pt-4">
                <Button :disabled="loading" @click="submit">
                    {{ loading ? 'Saving...' : 'Save Changes' }}
                </Button>
            </div>
        </div>
    </div>
</template>