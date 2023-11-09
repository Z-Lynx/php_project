<script setup>
import { computed } from "vue";
import Logo from "./Logo.vue";
import store from "../store";
import Search from "./Search.vue";
import Profile from "./Profile.vue";
const dataRoute = {};
</script>

<template>
  <header class="container flex items-center">
    <Logo />

    <ul class="flex space-x-6">
      <li><router-link to="/">HOME</router-link></li>
      <li><router-link to="/">PRODUCT</router-link></li>
      <li><router-link to="/">CART</router-link></li>
      <li><router-link to="/">BLOG</router-link></li>
    </ul>
    <div class="flex w-full items-center justify-end space-x-12">
      <Search />
      <Profile />
    </div>
  </header>
</template>
