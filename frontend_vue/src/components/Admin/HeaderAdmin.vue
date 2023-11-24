<script setup>
import Logo from "../Logo.vue";
import ProfileAdmin from "./ProfileAdmin.vue";
</script>

<template>
  <header class="container flex items-center">
    <Logo />
    
    <div class="flex w-full items-center justify-end space-x-12">
      <ProfileAdmin />
    </div>
  </header>
</template>
