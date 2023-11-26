import { createRouter, createWebHistory } from "vue-router";

import AppLayout from "../components/Guest/AppLayout.vue";
import AuthLayout from "../components/Guest/AuthLayout.vue";

import Products from "../views/Products/Products.vue";
import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import Checkout from "../views/Checkout/Checkout.vue";
import NotFound from "../views/NotFound.vue";
import VerifyEmail from "../views/auth/VerifyEmail.vue";
import ForgotPassword from "../views/auth/ForgotPassword.vue";
import ResetPassword from "../views/auth/ResetPassword.vue";
import Review from "../views/Review/Review.vue";
import Admin from "../views/Admin/Admin.vue";
import Category from "../views/Admin/Category.vue";
import Product from "../views/Admin/Product.vue";
import AdminLayout from "../components/admin/AdminLayout.vue";
import Users from "../views/Admin/Users.vue";
import Carts from "../views/Admin/Carts.vue";
import Bills from "../views/Admin/Bills.vue";
import SendNotifications from "../views/Admin/SendNotifications.vue";
import ImageProducts from "../views/Admin/ImageProducts.vue";

const routes = [
  {
    path: "/auth",
    name: "auth",
    component: AuthLayout,
    meta: {
      requiresGuest: true,
    },
    children: [
      {
        path: "login",
        name: "login",
        component: Login,
        meta: {
          requiresGuest: true,
        },
      },
      {
        path: "register",
        name: "register",
        component: Register,
        meta: {
          requiresGuest: true,
        },
      },
      {
        path: "forgot_password",
        name: "forgotPassword",
        component: ForgotPassword,
        meta: {
          requiresGuest: true,
        },
      },
      {
        path: "/reset-password",
        name: "/reset-password",
        component: ResetPassword,
        meta: {
          requiresGuest: true,
        },
      },
    ],
  },
  {
    path: "/verify/:id/:token",
    name: "verify",
    component: VerifyEmail,
  },
  {
    path: "/:pathMatch(.*)",
    name: "notfound",
    component: NotFound,
  },
  {
    path: "/",
    redirect: "/home",
  },
  {
    path: "/admin",
    name: "admin",
    component: AdminLayout,
    meta: {
      requiresAdmin: true,
    },
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: Admin,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "categories",
        name: "categories",
        component: Category,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "products",
        name: "products",
        component: Product,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "image-products",
        name: "image-products",
        component: ImageProducts,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "users",
        name: "product",
        component: Users,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "carts",
        name: "carts",
        component: Carts,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "bills",
        name: "bills",
        component: Bills,
        meta: {
          requiresAdmin: true,
        },
      },
      {
        path: "send-notification",
        name: "send-notification",
        component: SendNotifications,
        meta: {
          requiresAdmin: true,
        },
      }
    ],
  },
  {
    path: "/",
    name: "home",
    component: AppLayout,
    meta: {
      requiresGuest: true,
    },
    children: [
      {
        name: "Home",
        component: Products,
        path: "/home",
      },
      {
        name: "Product",
        component: Products,
        path: "products",
      },
      {
        name: "product-details",
        component: Review,
        path: "product-details/:id",
      },
      {
        name: "my-cart",
        component: Checkout,
        path: "my-cart",
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [],
  routes,
});

export default router;
