<template>
  <div class="flex flex-col container mx-auto mt-10 h-full">
    <div class="grow">
      <h1 class="text-2xl font-bold mb-4">Product Details</h1>
      <hr class="border-t-2 border-orange-500 my-4" />
      <section class="relative text-gray-700 body-font overflow-hidden bg-white" v-if="data !== null">
        <div class="mx-auto flex flex-wrap">
          <div class="lg:w-1/2 flex justify-center space-y-2 w-full">
            <img class="object-cover object-center rounded border border-gray-200 min-w-full max-h-[500px]" :src="srcImage" />
          </div>
          <div class="flex space-x-2 mt-2 overflow-auto md:overflow-hidden w-full">
            <img @click="handleChangeImage(item)" v-for="item of dataImageDetail" class="object-cover object-center rounded border border-gray-200 w-[150px] h-[150px]" :src="item.image" />
          </div>
          <div class="md:absolute md:right-0 lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
            <h2 class="text-sm title-font text-gray-500 tracking-widest mb-2">CATEGORY: {{ data.category.name }}</h2>
            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ data.name }}</h1>
            <p class="leading-relaxed">{{ data.description }}</p>
            <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
              <div class="flex items-center">
                <span class="mr-3">Quantity</span>
                <div class="relative">
                  <input v-model="quantity" type="number" id="quantity" name="quantity" min="1" max="5" class="w-16 h-8 pl-2 bg-white border rounded-md text-gray-900 focus:outline-none focus:border-orange-500 text-center" />
                </div>
              </div>
            </div>
            <div class="flex">
              <span class="title-font font-medium text-2xl text-gray-900">{{ data.price }} $</span>
              <button @click="handleAddToCart" class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Add to cart</button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import ClientService from "../../services/client.service";
import { useRoute } from "vue-router";
import store from "../../store";

const quantity = ref(1);
const data = ref(null);
const route = useRoute();
const srcImage = ref("");
const dataImageDetail = ref([]);
onMounted(async () => {
  const productId = ref(route.params.id);
  const response = await ClientService.getProductDetail(productId.value);

  srcImage.value = response.data.image;
  dataImageDetail.value = response.data.image_detail;
  dataImageDetail.value.unshift({ image: response.data.image });
  console.log(dataImageDetail.value);
  data.value = response.data;
});

const handleChangeImage = (item) => {
  srcImage.value = item.image;
};

const handleAddToCart = async () => {
  try {
    const dataCart = {
      product_id: data.value.id,
      quantity: quantity.value,
    };
    const res = await ClientService.addToCart(dataCart);
    store.dispatch("addToCart", res.data);
  } catch (err) {
    console.log(err);
  }
};
</script>
