<template>
  <div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Product</h1>
    <hr class="border-t-2 border-orange-500 my-4" />
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
      <product-card v-for="product in products" :key="product.id" :product="product" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import ClientService from "../../services/client.service";
import ProductCard from "../../components/Product/ProductCard.vue";
const products = ref([]);

onMounted(async () => {
  const response = await ClientService.getProducts();
  const data = await response.data;
  products.value = data;
});
</script>
