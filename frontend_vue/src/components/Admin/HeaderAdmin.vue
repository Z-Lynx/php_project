<script setup>
import Logo from "../UI/Logo.vue";
import ProfileAdmin from "./ProfileAdmin.vue";
</script>

<template>
  <div class=" flex justify-between items-center z-30 w-full bg-white border-b">
    <div class="grow-0">
      <Logo />
    </div>

    <div class="flex justify-end p-2 md:mt-0 md:p-0 md:pr-2 items-center space-x-12">
      <ProfileAdmin />
    </div>
  </div>
</template>
