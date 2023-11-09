import { createRouter, createWebHistory } from "vue-router";
import Products from "../components/Products.vue"
import ProductDetails from "../components/ProductDetails.vue"

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
    name: 'ProductDetails',
    component: ProductDetails,
    path: '/product-details'
  },
];


export default router;
