<template>
    <div class="container mx-auto mt-10">
      <h1 class="text-2xl font-bold mb-4">Danh sách sản phẩm</h1>
      <div class="grid grid-cols-3 gap-4">
        <product-card v-for="product in products" :key="product.id" :product="product" />
      </div>
    </div>
  </template>
  
  <script>
  import ProductCard from "../";
  
  export default {
    components: {
      ProductCard,
    },
    data() {
      return {
        products: [
          {
            id: 1,
            name: "Sản phẩm 1",
            description: "Mô tả sản phẩm 1",
            price: 100000,
          },
          {
            id: 2,
            name: "Sản phẩm 2",
            description: "Mô tả sản phẩm 2",
            price: 150000,
          },
          {
            id: 3,
            name: "Sản phẩm 3",
            description: "Mô tả sản phẩm 3",
            price: 200000,
          },
        ],
      };
    },
  };
  </script>
  