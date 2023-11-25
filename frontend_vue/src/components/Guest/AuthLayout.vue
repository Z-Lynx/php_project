<template>
  <div class="flex h-screen items-center justify-center">
    <router-link to="/home" class="absolute top-4 left-4">
      <i class="fa-solid fa-2x fa-arrow-left"></i>
    </router-link>
    <div class="rounded bg-white p-8 shadow-md w-[400px]">
      <RouterView />
      <!-- Or -->
      <div class="mb-4 flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-gray-300 after:mt-0.5 after:flex-1 after:border-t after:border-gray-300 dark:before:border-gray-500 dark:after:border-gray-500">
        <p class="mx-4 mb-0 text-center text-sm text-gray-400 dark:text-gray-400">or</p>
      </div>

      <div class="flex-col flex w-full items-center space-y-2">
        <LoginGmail @click="loginWithGmail" />
        <LoginGitHub @click="loginWithGithub" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

import LoginGmail from "./LoginGmail.vue";
import LoginGitHub from "./LoginGitHub.vue";
import { useToast } from "primevue/usetoast";
import { useRouter } from "vue-router";
import store from "../../store";

const toast = useToast();
const router = useRouter();

const onMessage = (e) => {
  if (e.origin !== "http://localhost:8000" || !e.data.response) {
    return;
  }
  store.dispatch("setUser", e.data.response);

  toast.add({
    severity: "success",
    summary: "Login successful",
    detail: "Login successful",
    life: 1500,
  });
  return router.push("/home");
};

onMounted(() => {
  window.addEventListener("message", onMessage, false);
});

onBeforeUnmount(() => {
  window.removeEventListener("message", onMessage);
});

const loginWithGithub = () => {
  openWindow(`http://localhost:8000/api/auth/github/`, "Login with Github", { width: 500, height: 600 });
};

const loginWithGmail = () => {
  openWindow(`http://localhost:8000/api/auth/google/`, "Login with Google", { width: 500, height: 600 });
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
