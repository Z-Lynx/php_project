import { createRouter, createWebHistory } from "vue-router";
import Products from "../components/Products.vue"
import Products from "../components/Products.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [],
});

const routes = [
  {
    name: 'Product',
    component: Products,
    path: '/products'
  },
  {
    name: 'Product Details',
    component: ProductDetails,
    path: '/product-details'
  },
];


export default router;
