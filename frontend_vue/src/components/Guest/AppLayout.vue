<template>
  <div class="flex flex-col min-h-screen">
    <div class="sticky top-0" style="z-index: 999">
      <Header />
    </div>
    <div v-if="data.data !== null && isShow && !data.data.is_active" class="container flex justify-center">
      <div class="relative bg-white p-8 rounded shadow-md w-full">
        <button @click="turnOffNotifi" class="absolute right-4 top-4">
          <i class="fa-2x fa-solid fa-xmark"></i>
        </button>
        <h1 class="text-2xl font-bold mb-4">Activate Your Account</h1>
        <p class="text-gray-600 mb-6">Check your email to activate your account. If you haven't received an email, please make sure to check your spam folder.</p>
        <button @click="resendActivate" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Resend Activation Email</button>
      </div>
    </div>
    <div class="flex-grow px-3 pb-10">
      <RouterView />
    </div>
    <Footer />
  </div>
</template>

<script setup>
import Header from "../UI/Header.vue";
import Footer from "../UI/Footer.vue";
import store from "../../store";
import { ref, onMounted, onBeforeUnmount } from "vue";
import authService from "../../services/auth.service";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const data = ref(store.getters.getUser);
const isShow = ref(true);

const turnOffNotifi = () => {
  isShow.value = false;
};

const resendActivate = () => {
  authService
    .resendActivateUser()
    .then((response) => {
      toast.add({
        severity: "success",
        summary: "Resend Verify Email successful",
        detail: response.message,
        life: 1500,
      });

      setTimeout(() => {
        router.push("/");
      }, 1000);
    })
    .catch((error) => {
      toast.add({
        severity: "error",
        summary: "Resend Verify Email failed",
        detail: error.response.data.message,
        life: 1500,
      });
    });
};

</script>
