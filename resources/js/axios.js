import axios from 'axios'

const instance = axios.create({
    baseURL: import.meta.env.API_BASE_URL || "http://shoplite.test/api/v1",
    withCredentials: true,
})

instance.interceptors.request.use((config) => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})
export default instance
