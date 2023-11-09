<template>
  <router-link :to="{ name: 'product-details', params: { id: product.id } }">
    <div class="bg-white p-4 shadow-md">
      <h2 class="text-lg font-semibold">{{ product.name }}</h2>
      <p class="text-gray-600">{{ product.description }}</p>
      <div class="mt-4">
        <span class="text-blue-500 font-semibold"
          >Giá: {{ product.price }} đ</span
        >
      </div>
    </div>
  </router-link>
</template>
  
  <script>
export default {
  props: {
    product: Object,
  },
};
</script>
  