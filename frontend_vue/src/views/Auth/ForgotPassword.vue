<template>
  <h2 class="flex items-center justify-center text-2xl font-semibold">Forget Password</h2>
  <h2 class="flex items-center justify-center mb-6 text-xl font-semibold">TSC Shop</h2>
  <form @submit.prevent="forgetPassword">
    <div class="mb-4">
      <label for="phone" class="mb-2 block text-sm text-gray-600">Email</label>
      <input v-model="formData.email" type="tel" id="phone" name="phone" class="w-full rounded border p-2" />
      <span v-if="isSumbit && !isEmailValid" class="text-red-500 text-sm">Please enter a valid email address.</span>
    </div>

    <button type="submit" class="mb-2 w-full rounded bg-green-500 p-2 text-white">
      <div class="flex justify-center items-center" v-if="isLoading">
        <LoadingSpiner />
      </div>
      <div v-else>Send Email</div>
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

const formData = ref({
  email: "",
});

const isEmailValid = computed(() => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(formData.value.email);
});

const isFormValid = computed(() => {
  return isEmailValid.value;
});

const forgetPassword = () => {
  isSumbit.value = true;

  if (isFormValid.value) {
    isLoading.value = true;

    AuthService.forgotPassword(formData.value.email)
      .then((response) => {
        toast.add({
          severity: "success",
          summary: "Send Email successful",
          detail: response.message,
          life: 2500,
        });
      })
      .catch((error) => {
        isLoading.value = false;
        // Handle login error
        toast.add({
          severity: "error",
          summary: "Send Email failed",
          detail: error.response.data.message,
          life: 2500,
        });
      });
  }
};
</script>
