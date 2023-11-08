import './index.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Admin from './admin/Admin.vue'
import store from "./store";


const app = createApp(Admin)

app.use(store)
app.use(router)

app.mount('#app')
