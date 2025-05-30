<script setup>
import { ref } from 'vue'
import axios from '@/axios.js'

const form = ref({
    email: '',
    password: ''
})

const handleLogin = async () => {
    try {
        const response = await axios.post('/admin/login', form.value)

        console.log('Login successful', response.data)
    } catch (error) {
        alert('Login failed')
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
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Password</label>
                    <input v-model="form.password" type="password" required class="w-full px-3 py-2 border rounded" />
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 rounded hover:bg-opacity-80 transition">
                    Login
                </button>
            </form>
        </div>
    </div>
</template>
