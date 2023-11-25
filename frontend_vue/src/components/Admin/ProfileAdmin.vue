<template>
  <div class="flex items-center space-x-3">
    <div v-if="user !== null" class="relative">
      <div class="flex items-center space-x-2">
        <button class="relative" @click="showNotifications">
          <i id="user-notifications" class="fa-solid fa-bell fa-2x"></i>
          <div v-if="countNotifications > 0" class="absolute top-0 right-0">
            <div class="bg-red-500 flex justify-center w-4 h-4 rounded-full">
              <p class="text-sm">
                {{ countNotifications }}
              </p>
            </div>
          </div>
        </button>
        <button @click="showMenuProfile" type="button" class="flex text-sm bg-gray-800 rounded md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
          <img id="user-menu-button" class="w-10 h-10 rounded" :src="user.avatar" alt="User Avatar" />
        </button>
      </div>
      <div v-show="isNotifications" class="overflow-auto pb-5 min-w-[250px] max-h-[250px] absolute right-0 z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <div class="text-lg font-semibold flex justify-center">Thông báo</div>
          <div v-for="item in notifications" class="flex items-center justify-between pb-2">
            <div class="flex items-center">
              <img id="user-menu-button" class="mr-2 w-10 h-10 rounded" src="http://127.0.0.1:8000/api/images/default_avatar.jpg" alt="User Avatar">
              <a class="text-start max-w-[150px] text-ellipsis block py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                {{ item.data }}
              </a>
            </div>
            <button @click="handleReadNotifications(item)" v-bind:class="item.read_at ? '' : 'bg-blue-500'" class="flex w-3 h-3 rounded-full"></button>
          </div>
        </div>
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
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import store from "../../store";
import { computed } from "vue";
import router from "../../router";
import authService from "../../services/auth.service";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const isMenuVisible = ref(false);
const isNotifications = ref(false);
const user = computed(() => store.state.user.data);

const notifications = computed(() => store.state.user.notifications);
const countNotifications = computed(() => store.state.user.countNotifications);

const menuAdminItems = [
  { id: "home", label: "Home", link: "/home" },
  { id: "settings", label: "Settings", link: "#2" },
  { id: "logout", label: "Sign out", link: "#3" },
];

const showMenuProfile = () => {
  isMenuVisible.value = !isMenuVisible.value;
  isNotifications.value = false;
};

const showNotifications = () => {
  isNotifications.value = !isNotifications.value;
  isMenuVisible.value = false;
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
          life: 1500,
        });
      })
      .catch((error) => {
        // Handle login error
        toast.add({
          severity: "error",
          summary: "LogOut failed",
          detail: error.response.data.message,
          life: 1500,
        });
      });
    router.push("/auth/login");
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
  if (event.srcElement.id !== "user-notifications") {
    isNotifications.value = false;
  }
};

const handleReadNotifications = async (item) => {
  try {
    const response = await authService.readNotifications(item.id);
    store.dispatch("readNotifications", item.id);
  } catch (error) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: error.response.data.message,
      life: 1500,
    });
  }
};
</script>
