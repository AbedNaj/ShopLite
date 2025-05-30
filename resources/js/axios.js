import axios from 'axios'

const instance = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL || 'http://shoplite.test',
    withCredentials: true,
})

export default instance
