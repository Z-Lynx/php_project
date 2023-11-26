<template>
  <router-link :to="{ name: 'product-details', params: { id: product.id } }">
    <div class="bg-white p-4 shadow-md max-h-[32rem] max-w-xs	 min-h-80">
      <img :src="product.image" alt="Product Image" class="w-full h-64  mb-2" />
      <h2 class="text-lg font-semibold w-full truncate">{{ product.name }}</h2>
      <div class="flex items-center justify-between">
        <p class="text-gray-600 line-through hidden md:block">{{ product.price }} $</p>
        <p class="text-red-500">{{ product.sale_price }} $</p>
      </div>
    </div>
  </router-link>
</template>

<script setup>
import { defineProps } from "vue";
const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
});
</script>
