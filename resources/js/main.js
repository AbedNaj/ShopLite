import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import 'primeicons/primeicons.css'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const app = createApp(App)

const pinia = createPinia()
app.use(pinia)

import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()


app.use(router)
app.use(Toast)
await auth.init()
app.mount('#app')
