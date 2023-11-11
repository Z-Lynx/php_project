<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
  <Header />
  <RouterView />
  <div class="pt-10">
    <Footer />
  </div>
</template>
