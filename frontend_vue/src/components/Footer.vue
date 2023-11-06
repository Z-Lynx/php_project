<script setup>
const year = new Date().getFullYear();
</script>

<template>
  <footer class="w-full flex flex-col items-center justify-center text-base font-semibolbd bg-[#D9D9D9] py-5">
    <div class="flex space-x-8">
      <p>About us</p>
      <p>Contact</p>
      <p>Help</p>
    </div>
    <div class="pt-2">
      <p>TSC © {{ year }}</p>
    </div>
  </footer>
</template>
