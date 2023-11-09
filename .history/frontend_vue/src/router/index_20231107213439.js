import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [],
});

const routes = [
  {
    name: 'Product',
    component: Product,
    
  }
]


export default router;
