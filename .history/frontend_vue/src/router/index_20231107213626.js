import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [],
});

const routes = [
  {
    name: 'Product',
    component: Product,
    path: '/products'
  },
  {
    name: 'Product Details',
    component: ProductDetails,
    path: '/products'
  },
];


export default router;