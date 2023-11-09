<template>
    <div class="container mx-auto mt-10">
      <h1 class="text-2xl font-bold mb-4">Product</h1>
      <hr class="border-t-2 border-orange-500 my-4" />
      <div class="grid grid-cols-4 gap-4">
        <product-card v-for="product in products" :key="product.id" :product="product" />
      </div>
    </div>
  </template>
  
  <script>
  import ProductCard from "../../";
  
  export default {
    components: {
      ProductCard,
    },
    data() {
      return {
        products: [
          {
            id: 1,
            name: "Product 1",
            description: "Description for Product 1",
            price: 100,
            image: "product1.jpg",
          },
          {
            id: 2,
            name: "Product 2",
            description: "Description for Product 2",
            price: 150,
            image: "product2.jpg",
          },
          {
            id: 3,
            name: "Product 3",
            description: "Description for Product 3",
            price: 200,
            image: "product3.jpg",
          },
          {
            id: 4,
            name: "Product 4",
            description: "Description for Product 4",
            price: 250,
            image: "product4.jpg",
          },
        ],
      };
    },
  };
  </script>
  