<template>
  <div class="flex items-center space-x-3">
    <div v-if="user !== null" class="relative">
      <div class="flex items-center space-x-2">
        <i class="fa-solid fa-bell fa-2x"></i>
        <button @click="showMenuProfile" type="button" class="flex text-sm bg-gray-800 rounded md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
          <img id="user-menu-button" class="w-10 h-10 rounded" :src="user.avatar" alt="User Avatar" />
        </button>
      </div>
      <div v-show="isMenuVisible" class="min-w-[200px] max-w-[200px] absolute right-0 z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white">{{ user.name }}</span>
          <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ user.email }}</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li v-for="item in user.is_admin ? menuAdminItems : menuItems" :key="item.id">
            <a @click="handleRouter(item)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
              {{ item.label }}
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="flex items-center space-x-3" v-else>
      <router-link to="/login">
        <button class="hidden md:block bg-black text-white px-3 py-1">SIGN IN</button>
      </router-link>
      <router-link to="/register">
        <button class="hidden lg:block bg-white text-black px-3 py-1 border border-black" @click="login">SIGN UP</button>
      </router-link>
    </div>

    <router-link to="/cart">
      <i class="ml-5 fa-solid fa-cart-shopping fa-2x"></i>
    </router-link>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import store from "../store";
import { computed } from "vue";
import router from "../router";
import authService from "../services/auth.service";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const isMenuVisible = ref(false);
const user = computed(() => store.state.user.data);

const menuItems = [
  { id: "settings", label: "Settings", link: "#1" },
  { id: "logout", label: "Sign out", link: "#2" },
];

const menuAdminItems = [
  { id: "dashboard", label: "Dashboard", link: "#1" },
  { id: "settings", label: "Settings", link: "#2" },
  { id: "logout", label: "Sign out", link: "#3" },
];

const showMenuProfile = () => {
  isMenuVisible.value = !isMenuVisible.value;
};
const handleRouter = (item) => {
  if (item.id === "logout") {
    authService
      .logout()
      .then((response) => {
        toast.add({
          severity: "success",
          summary: "LogOut successful",
          detail: response.message,
          life: 2500,
        });
      })
      .catch((error) => {
        // Handle login error
        toast.add({
          severity: "error",
          summary: "LogOut failed",
          detail: error.response.data.message,
          life: 2500,
        });
      });
    router.push("/login");
  } else {
    router.push(item.link);
  }
};
onMounted(() => {
  document.addEventListener("click", closeMenuOutside);
});

onUnmounted(() => {
  document.removeEventListener("click", closeMenuOutside);
});

const closeMenuOutside = (event) => {
  if (event.srcElement.id !== "user-menu-button") {
    isMenuVisible.value = false;
  }
};
</script>
