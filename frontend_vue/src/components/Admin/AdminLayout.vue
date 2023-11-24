<template>
    <HeaderAdmin />
    <div class="flex-grow">
      <RouterView />
    </div>
    <Footer />
</template>

<script setup>
import HeaderAdmin from "./HeaderAdmin.vue";
import Footer from "../Footer.vue";
</script>