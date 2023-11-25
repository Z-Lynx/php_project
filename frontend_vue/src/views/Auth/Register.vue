<template>
  <h2 class="flex items-center justify-center text-2xl font-semibold">Welcome back</h2>
  <h2 class="flex items-center justify-center mb-6 text-xl font-semibold">TSC Shop</h2>
  <form @submit.prevent="register">
    <div class="mb-4">
      <label for="email" class="mb-2 block text-sm text-gray-600">Email</label>
      <input v-model="formData.email" type="email" id="email" name="email" class="w-full rounded border p-2" />
      <span v-if="isSumbit && !isEmailValid" class="text-red-500 text-sm">Please enter a valid email address.</span>
    </div>

    <div class="mb-4">
      <label for="username" class="mb-2 block text-sm text-gray-600">Name</label>
      <input v-model="formData.name" type="text" id="username" name="username" class="w-full rounded border p-2" />
      <span v-if="isSumbit && !isUsernameValid" class="text-red-500 text-sm">Username must be at least 3 characters long.</span>
    </div>

    <div class="relative mb-4">
      <label for="password" class="mb-2 block text-sm text-gray-600">Password</label>
      <input v-model="formData.password" :type="showPassword ? 'text' : 'password'" id="password" name="password" class="w-full rounded border p-2" />
      <span v-if="isSumbit && !isPasswordValid" class="text-red-500 text-sm">Password must be at least 6 characters long.</span>
      <span @click="toggleShowPasspord" class="absolute top-9 right-5 cursor-pointer text-gray-400 dark:text-night-300">
        <i v-if="showPassword" class="fa-lg fa-solid fa-eye"></i>
        <i v-else class="fa-lg fa-solid fa-eye-slash"></i>
      </span>
    </div>

    <div class="relative mb-4">
      <label for="confirmPassword" class="mb-2 block text-sm text-gray-600">Confirm Password</label>
      <input v-model="formData.password_confirmation" :type="showPassword ? 'text' : 'password'" id="confirmPassword" name="confirmPassword" class="w-full rounded border p-2" />
      <span v-if="(isSumbit && !isPasswordValid) || formData.password !== formData.password_confirmation" class="text-red-500 text-sm">Passwords do not match.</span>
      <span @click="toggleShowPasspord" class="absolute top-9 right-5 cursor-pointer text-gray-400 dark:text-night-300">
        <i v-if="showPassword" class="fa-lg fa-solid fa-eye"></i>
        <i v-else class="fa-lg fa-solid fa-eye-slash"></i>
      </span>
    </div>

    <button type="submit" class="mb-2 w-full rounded bg-green-500 p-2 text-white">
      <div class="flex justify-center items-center" v-if="isLoading">
        <LoadingSpiner />
      </div>
      <div v-else>Register</div>
    </button>
    <p class="py-2 text-sm font-light text-gray-500 dark:text-gray-400">
      Already have an account?
      <router-link to="/auth/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500"> Sign in </router-link>
    </p>
  </form>
</template>

<script setup>
import { ref, computed } from "vue";
import AuthService from "../../services/auth.service";
import { useToast } from "primevue/usetoast";
import { useRouter } from "vue-router";
import LoadingSpiner from "../../components/UI/LoadingSpiner.vue";

const router = useRouter();
const toast = useToast();
const isSumbit = ref(false);
const isLoading = ref(false);
const showPassword = ref(false);

const toggleShowPasspord = () => {
  showPassword.value = !showPassword.value;
};

const formData = ref({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const isEmailValid = computed(() => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(formData.value.email);
});

const isPasswordValid = computed(() => {
  return formData.value.password.length >= 6;
});

const isFormValid = computed(() => {
  return isEmailValid.value && isPasswordValid.value && isUsernameValid.value && formData.value.password === formData.value.password_confirmation;
});

const isUsernameValid = computed(() => {
  return formData.value.name.length >= 3;
});

const register = () => {
  isSumbit.value = true;

  if (isFormValid.value) {
    isLoading.value = true;

    const user = {
      name: formData.value.name,
      email: formData.value.email,
      password: formData.value.password,
      password_confirmation: formData.value.password_confirmation,
    };

    AuthService.register(user)
      .then((response) => {
        toast.add({
          severity: "success",
          summary: "Register successful",
          detail: response.message,
          life: 1500,
        });
        router.push("/");
      })
      .catch((error) => {
        isLoading.value = false;
        toast.add({
          severity: "error",
          summary: "Register failed",
          detail: error.response.data.message,
          life: 1500,
        });
      });
  }
};
</script>
