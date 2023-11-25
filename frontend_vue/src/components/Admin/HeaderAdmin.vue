<script setup>
import Logo from "../Logo.vue";
import ProfileAdmin from "./ProfileAdmin.vue";
</script>

<template>
  <div class=" flex justify-between items-center z-30 w-full bg-white border-b">
    <div class="grow">
      <Logo />
    </div>

    <div class="flex justify-end p-2 md:mt-0 md:p-0 md:pr-2 items-center space-x-12">
      <ProfileAdmin />
    </div>
  </div>
</template>
