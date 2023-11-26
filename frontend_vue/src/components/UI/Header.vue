<script setup>
import { ref } from "vue";
import Logo from "./Logo.vue";
import Search from "./Search.vue";
import Profile from "./Profile.vue";

const isSidebarOpen = ref(false);

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<template>
  <div class="relative container flex items-center bg-white border-b h-[80px]">
    <Logo />
    <ul class="space-x-6 hidden sm:flex">
      <li>
        <router-link to="/" :class="{ 'text-green-500 font-bold': $route.path === '/' || $route.path === '/home' }"> HOME </router-link>
      </li>
      <li>
        <router-link to="/products" :class="{ 'text-green-500 font-bold': $route.path === '/products' || $route.path.includes('/product-details/') }">PRODUCT</router-link>
      </li>
    </ul>
    <div class="flex w-full items-center justify-end space-x-12">
      <Search />
      <Profile />
    </div>

    <button @click="toggleSidebar" style="z-index: 9999" type="button" class="fixed p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
      <span class="sr-only">Open sidebar</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
      </svg>
    </button>

    <div style="z-index: 9999" class="absolute top-0" v-bind:class="isSidebarOpen ? 'block' : 'hidden'">
      <div class="w-screen" aria-label="Sidebar">
        <div class="pt-10 h-screen px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
          <ul class="pl-5 pt-5 space-y-6">
            <li class="text-2xl font-semibold">
              <router-link to="/" :class="{ 'text-green-500 font-bold': $route.path === '/' || $route.path === '/home' }"> HOME </router-link>
            </li>
            <li class="text-2xl font-semibold">
              <router-link to="/products" :class="{ 'text-green-500 font-bold': $route.path === '/products' || $route.path.includes('/product-details/') }">PRODUCT</router-link>
            </li>
          </ul>
        </div>
      </div>
      <button @click="toggleSidebar" class="absolute top-5 right-5">
        <i class="fa-xl fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>
</template>
