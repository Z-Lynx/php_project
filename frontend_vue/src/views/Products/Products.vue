<template>
  <div class="flex flex-col container mx-auto mt-10 h-full">
    <div class="grow">
      <h1 class="text-2xl font-bold mb-4">Product Item</h1>
      <hr class="border-t-2 border-orange-500 my-4" />
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        <product-card v-for="product in products" :key="product.id" :product="product" />
      </div>
    </div>
    <div class="flex mt-8 justify-between">
      <div>
        <a v-if="prev_page_url !== null" :href="prev_page_url" class="bg-green-500 text-white px-7 py-2 rounded hover:bg-green-600">Previous Page</a>
      </div>
      <div>
        <a v-if="next_page_url !== null" :href="next_page_url" class="bg-green-500 text-white px-7 py-2 rounded hover:bg-green-600">Next Page</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import ClientService from "../../services/client.service";
import ProductCard from "../../components/Product/ProductCard.vue";
import { useRoute } from "vue-router";

const route = useRoute();
const page = ref(route.query.page || 1);
const next_page_url = ref(null);
const prev_page_url = ref(null);
const pagination = ref(null);

const products = ref([]);

onMounted(async () => {
  const response = await ClientService.getProducts(page.value);
  products.value = response.data;
  pagination.value = response.pagination;

  console.log(pagination.value);
  if (pagination.value.next_page_url != null) {
    next_page_url.value = window.location.href.split("?")[0] + "?" + pagination.value.next_page_url.split("?")[1];
  }

  if (pagination.value.prev_page_url != null) {
    prev_page_url.value = window.location.href.split("?")[0] + "?" + pagination.value.prev_page_url.split("?")[1];
  }
});
</script>
