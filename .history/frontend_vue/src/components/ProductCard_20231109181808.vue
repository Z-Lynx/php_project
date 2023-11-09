<template>
  <template>
  <div class="bg-white p-4 shadow-md">
    <img :src="require(`@/assets/${product.image}`)" alt="Product Image" class="w-full h-auto mb-2" />
    <h2 class="text-lg font-semibold">{{ product.name }}</h2>
    <p class="text-gray-600">{{ product.price }} đ</p>
  </div>
</template>

<script>
export default {
  props: {
    product: Object,
  },
};
</script>

  <div class="bg-white p-4 shadow-md">
    <img :src="require(`@/assets/${product.image}`)" alt="Product Image" class="w-full h-auto mb-2" />
    <h2 class="text-lg font-semibold">{{ product.name }}</h2>
    <p class="text-gray-600">{{ product.price }} đ</p>
  </div>
</template>

<script>
export default {
  props: {
    product: Object,
  },
};
</script>
