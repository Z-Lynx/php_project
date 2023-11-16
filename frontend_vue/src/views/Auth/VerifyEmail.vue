<template>
  <div class="flex flex-col items-center justify-center">
    <Logo />
    <div class="flex text-green-500">
      <div class="items-center mr-2 inline-block h-5 w-5 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status"></div>
      Verify Email ....
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import AuthService from "../../services/auth.service";
import Logo from "../../components/Logo.vue";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const router = useRouter();
const route = useRoute();

const id = ref(route.params.id);
const token = ref(route.params.token);
const expires = ref(route.query.expires);
const signature = ref(route.query.signature);
const code = ref(id.value + "/" + token.value + "?expires=" + expires.value + "&signature=" + signature.value);

AuthService.activateUser(code.value)
  .then((response) => {
    toast.add({
      severity: "success",
      summary: "Verify Email successful",
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
      summary: "Verify Email failed",
      detail: error.response.data.message,
      life: 2500,
    });
  });
</script>
