<template>
  <h2 class="flex items-center justify-center text-2xl font-semibold">Welcome back</h2>
  <h2 class="flex items-center justify-center mb-6 text-xl font-semibold">TSC Shop</h2>
  <form @submit.prevent="login">
    <div class="mb-4">
      <label for="phone" class="mb-2 block text-sm text-gray-600">Email</label>
      <input v-model="formData.email" type="tel" id="phone" name="phone" class="w-full rounded border p-2" />
      <span v-if="isSumbit && !isEmailValid" class="text-red-500 text-sm">Please enter a valid email address.</span>
    </div>

    <div class="mb-4 relative">
      <label for="password" class="mb-2 block text-sm text-gray-600">Password</label>
      <input v-model="formData.password" :type="showPassword ? 'text' : 'password'" id="password" name="password" class="w-full rounded border p-2" />
      <span v-if="isSumbit && !isPasswordValid" class="text-red-500 text-sm">Password must be at least 6 characters long.</span>
      <span @click="toggleShowPasspord" class="absolute top-9 right-5 cursor-pointer text-gray-400 dark:text-night-300">
        <i v-if="showPassword" class="fa-lg fa-solid fa-eye"></i>
        <i v-else class="fa-lg fa-solid fa-eye-slash"></i>
      </span>
    </div>
    <div class="mb-2 flex justify-end">
      <router-link to="/auth/forgot_password" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"> Forgot password? </router-link>
    </div>
    <button type="submit" class="mb-2 w-full rounded bg-green-500 p-2 text-white">
      <div class="flex justify-center items-center" v-if="isLoading"><LoadingSpiner /></div>
      <div v-else>Login</div>
    </button>
    <p class="py-4 text-sm font-light text-gray-500 dark:text-gray-400">
      Don't have an account yet?
      <router-link to="/auth/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500"> Sign up </router-link>
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
  email: "",
  password: "",
});

const isEmailValid = computed(() => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(formData.value.email);
});

const isPasswordValid = computed(() => {
  return formData.value.password.length >= 6;
});

const isFormValid = computed(() => {
  return isEmailValid.value && isPasswordValid.value;
});

const login = () => {
  isSumbit.value = true;

  if (isFormValid.value) {
    isLoading.value = true;
    const user = {
      username: formData.value.email,
      password: formData.value.password,
    };

    AuthService.login(user)
      .then((response) => {
        toast.add({
          severity: "success",
          summary: "Login successful",
          detail: response.message,
          life: 2500,
        });
        router.push("/");
      })
      .catch((error) => {
        isLoading.value = false;
        // Handle login error
        toast.add({
          severity: "error",
          summary: "Login failed",
          detail: error.response.data.message,
          life: 2500,
        });
      });
  }
};
</script>
