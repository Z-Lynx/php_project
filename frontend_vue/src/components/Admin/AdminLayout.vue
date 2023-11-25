<template>
  <div class="flex h-screen overflow-hidden">
    <SideBar></SideBar>
    <div class="relative w-full grow overflow-auto">
      <div class="sticky top-0" style="z-index: 999">
        <HeaderAdmin />
      </div>
      <RouterView />
    </div>
  </div>
</template>

<script setup>
import HeaderAdmin from "./HeaderAdmin.vue";
import SideBar from "./SideBar.vue";
</script>
