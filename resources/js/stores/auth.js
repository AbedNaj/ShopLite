
import { defineStore } from 'pinia'
import axios from '@/axios'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: null,
    }),
    actions: {
        async login(data) {
            const response = await axios.post('/admin/login', data)

            this.token = response.data.token
            this.user = response.data.data

            localStorage.setItem('token', this.token)
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        },

        logout() {
            this.token = null
            this.user = null
            localStorage.removeItem('token')
            delete axios.defaults.headers.common['Authorization']
        },

        async init() {
            const token = localStorage.getItem('token')
            if (token) {
                this.token = token
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

                try {
                    const res = await axios.get('/admin/me')
                    this.user = res.data.data
                } catch (err) {
                    this.logout()
                }
            }
        }

    }
})
