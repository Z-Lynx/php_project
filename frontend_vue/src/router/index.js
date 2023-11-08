import { createRouter, createWebHistory } from "vue-router";
import Category from "../admin/Category.vue";
import Product from "../admin/Product.vue";
import User from "../admin/User.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: "/admin/product", component: Product },
    { path: "/admin/category", component: Category },
    { path: "/admin/user", component: User },
  ],
});

export default router;
