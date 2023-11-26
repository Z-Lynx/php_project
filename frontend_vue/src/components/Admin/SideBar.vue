<template>
  <div class="relative">
    
    <button @click="toggleSidebar" style="z-index: 9999" type="button" class="fixed p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
      <span class="sr-only">Open sidebar</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
      </svg>
    </button>

    <div style="z-index: 9999" class="absolute" v-bind:class="isSidebarOpen ? 'block' : 'hidden'">
      <div class="w-screen" aria-label="Sidebar">
        <div class="pt-10 h-screen px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
          <ul class="space-y-2 font-medium" v-for="item in menuItems">
            <li>
              <RouterLink :to="item.link" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="text-xl h-7 w-7" :class="item.icon"></i>
                <span class="ms-3"> {{ item.label }} </span>
              </RouterLink>
            </li>
          </ul>
        </div>
      </div>
      <button @click="toggleSidebar" class="absolute top-5 right-5">
       <i class="fa-xl fa-solid fa-xmark"></i>
      </button>
    </div>

    <div class="hidden h-screen min-w-[16rem] w-full md:block" aria-label="Sidebar">
      <div class="pt-10 h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium" v-for="item in menuItems">
          <li>
            <RouterLink :to="item.link" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <i class="text-xl h-7 w-7" :class="item.icon"></i>
              <span class="ms-3"> {{ item.label }} </span>
            </RouterLink>
          </li>
        </ul>
      </div>
    </div>
    
  </div>
</template>

<script setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";

const isSidebarOpen = ref(false);
const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};

const menuItems = [
  { id: "dashboard", label: "Dashboard", link: "/admin/dashboard", icon: "fa-solid fa-house" },
  { id: "users", label: "Users", link: "/admin/users", icon: "fa-solid fa-user" },
  { id: "categories", label: "Categories", link: "/admin/categories", icon: "fa-solid fa-certificate" },
  { id: "products", label: "Products", link: "/admin/products", icon: "fa-solid fa-bag-shopping" },
  { id: "image-products", label: "Image Products", link: "/admin/image-products", icon: "fa-solid fa-image" },
  { id: "carts", label: "Carts", link: "/admin/carts", icon: "fa-solid fa-cart-plus" },
  { id: "billings", label: "Billings", link: "/admin/bills", icon: "fa-solid fa-money-bill" },
  { id: "send-notifications", label: "Send Notifications", link: "/admin/send-notification", icon: "fa-solid fa-bell" },
];
</script>
