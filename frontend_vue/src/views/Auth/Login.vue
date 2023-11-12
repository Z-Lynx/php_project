<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-96 rounded bg-white p-8 shadow-md">
      <h2 class="mb-6 text-2xl font-semibold">Login</h2>

      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="phone" class="mb-2 block text-sm text-gray-600">Email</label>
          <input v-model="formData.email" type="tel" id="phone" name="phone" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isEmailValid" class="text-red-500 text-sm">Please enter a valid email address.</span>
        </div>

        <div class="mb-4">
          <label for="password" class="mb-2 block text-sm text-gray-600">Password</label>
          <input v-model="formData.password" type="password" id="password" name="password" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isPasswordValid" class="text-red-500 text-sm">Password must be at least 6 characters long.</span>
        </div>

        <button type="submit" class="w-full rounded bg-green-500 p-2 text-white">Login</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import AuthService from "../../services/auth.service";
import { useToast } from "primevue/usetoast";
import { useRouter } from 'vue-router'; // Import the useRouter function

const router = useRouter(); 
const toast = useToast();
const isSumbit = ref(false);
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
    const user = {
      username: formData.value.email,
      password: formData.value.password,
    };

    AuthService.login(user)
      .then((response) => {
        router.push("/");
      })
      .catch((error) => {
        // Handle login error
        toast.add({
          severity: "error",
          summary: "Login failed",
          detail: error.response.data.error,
          life: 2500,
        });
      });
  }
};
</script>
