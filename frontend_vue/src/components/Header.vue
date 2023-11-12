<script setup>
import Logo from "./Logo.vue";
import Search from "./Search.vue";
import Profile from "./Profile.vue";
</script>

<template>
  <header class="container flex items-center">
    <Logo />
    <ul class="flex space-x-6">
      <li>
        <router-link to="/" :class="{ 'text-green-500 font-bold': $route.path === '/' || $route.path === '/home' }"> HOME </router-link>
      </li>
      <li>
        <router-link to="/products" :class="{ 'text-green-500 font-bold': $route.path === '/products' || $route.path.includes('/product-details/') }">PRODUCT</router-link>
      </li>
      <li>
        <router-link to="/" :class="{ 'text-green-500 font-bold': $route.path === '/cart' }">CART</router-link>
      </li>
      <li>
        <router-link to="/" :class="{ 'text-green-500 font-bold': $route.path === '/reviews' }">REVIEWS</router-link>
      </li>
    </ul>
    <div class="flex w-full items-center justify-end space-x-12">
      <Search />
      <Profile />
    </div>
  </header>
</template>
