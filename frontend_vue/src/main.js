import './index.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import Button from "primevue/button"

import 'primevue/resources/themes/lara-light-teal/theme.css'


const app = createApp(App)

app.use(store)
app.use(router)
app.use(PrimeVue);
app.use(ToastService);
app.component('Button', Button);
app.mount('#app')
