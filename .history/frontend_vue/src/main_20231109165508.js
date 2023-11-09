import './index.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";
import "@progress/kendo-theme-default/dist/all.css"


Vue.config.productionTip = false
const app = createApp(App)

app.use(store)
app.use(router)

app.mount('#app')


new Vue({
    render: h => h(App),
   }).$mount('#app')