<template>
  <div class="flex flex-col min-h-screen">
    <div class="flex items-center justify-center w-full">
      <button @click="vnpayTest" class="max-w-[400px] w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">VNPAY TEST</button>
    </div>
    <Header />
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
    <div class="flex-grow">
      <RouterView />
    </div>
    <Footer />
  </div>
</template>

<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import store from "../store";
import { ref, onMounted, onBeforeUnmount } from "vue";
import authService from "../services/auth.service";
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
        life: 2500,
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
        life: 2500,
      });
    });
};

const onMessage = (e) => {
  if (e.origin !== "http://localhost:8000" || !e.data.response) {
    return;
  }

  toast.add({
    severity: "success",
    summary: "Thanh Toán Thành Công",
    detail: e.data.response.message,
    life: 2500,
  });
};

onMounted(() => {
  window.addEventListener("message", onMessage, false);
});

onBeforeUnmount(() => {
  window.removeEventListener("message", onMessage);
});

const vnpayTest = () => {
  openWindow(`http://localhost:8000/api/vnpay_payment`, "VNPAY TEST", { width: 500, height: 600 });
};

function openWindow(url, title, options = {}) {
  if (typeof url === "object") {
    options = url;
    url = "";
  }

  options = { url, title, width: 600, height: 720, ...options };

  const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left;
  const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top;
  const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width;
  const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height;

  options.left = width / 2 - options.width / 2 + dualScreenLeft;
  options.top = height / 2 - options.height / 2 + dualScreenTop;

  const optionsStr = Object.keys(options)
    .reduce((acc, key) => {
      acc.push(`${key}=${options[key]}`);
      return acc;
    }, [])
    .join(",");

  const newWindow = window.open(url, title, optionsStr);

  if (window.focus) {
    newWindow.focus();
  }

  return newWindow;
}
</script>
