import { createRouter, createWebHistory } from "vue-router";
import Products from "../views/Products/Products.vue";
import ProductDetails from "../views/ProductDetails/ProductDetails.vue";
import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import Checkout from "../views/Checkout/Checkout.vue";

const routes = [
  {
    name: "Login",
    component: Login,
    path: "/login",
  },
  {
    name: "Register",
    component: Register,
    path: "/register",
  },
  {
    name: "Home",
    component: Products,
    path: "/",
  },
  {
    name: "Product",
    component: Products,
    path: "/products",
  },
  {
    name: "product-details",
    component: ProductDetails,
    path: "/product-details/:id",
  },
  {
    name: "checkout",
    component: Checkout,
    path: "/checkout",
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [],
  routes,
});

export default router;
