<template>
  <div class="container flex flex-col min-h-screen">
    <h1 class="border-b py-6 text-4xl font-semibold">Settings</h1>
    <div class="pt-3 sm:grid-cols-10">
      <div class="relative my-4 w-56 sm:hidden">
        <input class="peer hidden" type="checkbox" name="select-1" id="select-1" />
        <label for="select-1" class="flex w-full cursor-pointer select-none rounded-lg border p-2 px-3 text-sm text-gray-700 ring-blue-700 peer-checked:ring">Accounts </label>
        <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute right-0 top-3 ml-auto mr-5 h-4 text-slate-700 transition peer-checked:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
        <ul class="max-h-0 select-none flex-col overflow-hidden rounded-b-lg shadow-md transition-all duration-300 peer-checked:max-h-56 peer-checked:py-3">
          <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Accounts</li>
          <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Team</li>
          <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Others</li>
        </ul>
      </div>
      <div class="col-span-8 overflow-hidden rounded-xl sm:bg-gray-50 sm:px-8 sm:shadow">
        <div class="pt-4">
          <h1 class="py-2 text-2xl font-semibold">Account settings</h1>
        </div>
        <hr class="mt-4 mb-8" />
        <p class="py-2 text-xl font-semibold">Avatar</p>
        <div class="flex space-x-2 items-center">
          <img :src="imageSrc" id="preview_img" class="h-24 w-24 object-cover rounded-full" alt="Business photo" />
          <input v-on:change="handleChangeImage($event)" id="image-user" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
        </div>
        <button @click="updateAvatar" class="mt-4 rounded-lg bg-blue-600 px-4 py-2 text-white">Update Avatar</button>
        <hr class="mt-4 mb-8" />

        <p class="py-2 text-xl font-semibold">Email Address</p>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <p class="text-gray-600">
            Your email address is <strong>{{ user.email }}</strong>
          </p>
        </div>
        <hr class="mt-4 mb-8" />
        <p class="py-2 text-xl font-semibold">Address</p>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <p class="text-gray-600">
          288 Lê Duẫn, Hải Châu, Đà Nẵng
          </p>
        </div>
        <hr class="mt-4 mb-8" />
        <p class="py-2 text-xl font-semibold">Name</p>
        <div class="flex flex-col">
          <p class="text-gray-600">
            Your Name is <strong>{{ user.name }}</strong>
          </p>
          <div class="mt-2 w-[200px]">
            <span class="text-sm text-gray-500">New Name</span>
            <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
              <input v-model="newName" type="text" id="name" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" :placeholder="user.name" />
            </div>
          </div>
        </div>
        <button @click="updateName" class="mt-4 rounded-lg bg-blue-600 px-4 py-2 text-white">Update Your Name</button>

        <hr class="mt-4 mb-8" />
        <p class="py-2 text-xl font-semibold">Password</p>
        <div class="flex items-center">
          <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-3">
            <label for="current-password">
              <span class="text-sm text-gray-500">Current Password</span>
              <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
                <input v-model="currentPassword" :type="isShowPassword ? 'text' : 'password'" id="current-password" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" placeholder="***********" />
              </div>
            </label>
            <label for="new-password">
              <span class="text-sm text-gray-500">New Password</span>
              <div class="relative flex overflow-hidden rounded-md border-2 transition focus-within:border-blue-600">
                <input v-model="newPassword" :type="isShowPassword ? 'text' : 'password'" id="new-password" class="w-full flex-shrink appearance-none border-gray-300 bg-white py-2 px-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none" placeholder="***********" />
              </div>
            </label>
          </div>
          <button @click="toggleShowPassword" class="pt-5 ml-2">
            <span class="cursor-pointer text-gray-400 dark:text-night-300">
              <i v-if="isShowPassword" class="fa-lg fa-solid fa-eye"></i>
              <i v-else class="fa-lg fa-solid fa-eye-slash"></i>
            </span>
          </button>
        </div>
        <button @click="updatePassword" class="mt-4 rounded-lg bg-blue-600 px-4 py-2 text-white">Save Password</button>
        <hr class="mt-4 mb-8" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import store from "../../store";
import clientService from "../../services/client.service";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const userData = store.getters.getUser;
const user = userData.data;
const imageSrc = ref(null);
const imageFile = ref(null);
const currentPassword = ref("");
const newPassword = ref("");
const newName = ref("");
const isShowPassword = ref(false);

onMounted(() => {
  imageSrc.value = user.avatar;
});

watch(store.getters.getUser, (newVal) => {
  imageSrc.value = newVal.data.avatar;
});

const handleChangeImage = (e) => {
  const file = e.target.files[0];
  imageFile.value = file;
  imageSrc.value = URL.createObjectURL(file);
};

const updateAvatar = async () => {
  try {
    const payload = {
      image: imageFile.value,
    };
    const response = await clientService.updateProfile(payload);
    toast.add({
      severity: "success",
      summary: "Success Message",
      detail: "Update Avatar Success",
      life: 3000,
    });
    store.dispatch("updateProfile", response.data);
  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error Message",
      detail: err.message,
      life: 3000,
    });
  }
};

const updateName = async () => {
  try {
    const payload = {
      name: newName.value,
    };
    const response = await clientService.updateProfile(payload);
    toast.add({
      severity: "success",
      summary: "Success Message",
      detail: "Update Name Success",
      life: 3000,
    });
    store.dispatch("updateProfile", response.data);

  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error Message",
      detail: err.message,
      life: 3000,
    });
  }
};

const updatePassword = async () => {
  const payload = {
    current_password: currentPassword.value,
    password: newPassword.value,
  };
  try {
    const response = await clientService.updateProfile(payload);
    toast.add({
      severity: "success",
      summary: "Success Message",
      detail: "Update Password Success",
      life: 3000,
    });
  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error Message",
      detail: err.message,
      life: 3000,
    });
  }
};

const toggleShowPassword = () => {
  isShowPassword.value = !isShowPassword.value;
};
</script>
