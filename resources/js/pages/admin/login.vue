<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useToast } from 'vue-toastification'


const toast = useToast({ position: 'bottom-right' })
const form = ref({
    email: '',
    password: ''
})


const errors = ref({})
const router = useRouter()
const auth = useAuthStore()

const handleLogin = async () => {
    errors.value = {}

    try {
        await auth.login(form.value)
        router.push({ name: 'admin.dashboard' })
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors
        } else if (error.response?.status === 401) {
            toast.error(error.response.data.message)
        } else {
            toast.error(' An unexpected error occurred. Please try again later.')
        }
    }

}
</script>

<template>


    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-sm p-6 bg-white rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

            <form @submit.prevent="handleLogin">
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Email</label>
                    <input v-model="form.email" type="email" required class="w-full px-3 py-2 border rounded" />
                    <p v-if="errors.email" class="text-sm text-red-500 mt-1">{{ errors.email[0] }}</p>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Password</label>
                    <input v-model="form.password" type="password" required class="w-full px-3 py-2 border rounded" />
                    <p v-if="errors.password" class="text-sm text-red-500 mt-1">{{ errors.password[0] }}</p>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-opacity-80 transition">
                    Login
                </button>
            </form>
        </div>
    </div>

</template>
