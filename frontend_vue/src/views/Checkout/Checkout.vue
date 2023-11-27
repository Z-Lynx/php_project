<template>
  <div class="flex flex-col container mx-auto mt-10 h-full">
    <div class="grow">
      <h1 class="text-2xl font-bold mb-4">Carts</h1>
      <hr class="border-t-2 border-orange-500 my-4" />
    </div>
    <div class="flex flex-col lg:flex-row shadow-md my-10">
      <div class="w-full lg:w-3/4 bg-white lg:px-10 lg:py-10 overflow-auto">
        <div class="flex mt-10 mb-5">
          <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product</h3>
          <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Quantity</h3>
          <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Price</h3>
          <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Total</h3>
        </div>

        <!-- product -->
        <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5" v-for="item of carts">
          <div class="flex w-2/5">
            <div class="w-20">
              <img class="h-24 w-20" :src="item.product.image" alt="" />
            </div>
            <div class="flex flex-col justify-between ml-4 flex-grow">
              <span class="w-[50px] lg:w-[200px] font-bold text-sm truncate lg:text-ellipsis overflow-hidden">{{ item.product.name }}</span>
              <span class="text-red-500 text-xs hidden lg:block">{{ item.product.description }}</span>
              <button @click="handleRemoveCart(item)" class="flex items-start font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</button>
            </div>
          </div>

          <div class="flex justify-center w-1/5">
            <button @click="handleSubQuantity(item)">
              <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" /></svg>
            </button>
            <div class="mx-2">
              {{ item.quantity }}
            </div>
            <button @click="handleAddQuantity(item)">
              <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
              </svg>
            </button>
          </div>
          <span class="text-center w-1/5 font-semibold text-sm">{{ item.product.sale_price }} $</span>
          <span class="text-center w-1/5 font-semibold text-sm">{{ item.price }} $</span>
        </div>

        <RouterLink to="/home" class="flex font-semibold text-indigo-600 text-sm mt-10">
          <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" /></svg>
          Continue Shopping
        </RouterLink>
      </div>
      <div id="summary" class="w-full lg:w-1/4 px-8 py-10">
        <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
        <div class="flex justify-between mt-10 mb-5" v-for="item of carts">
          <span class="font-semibold text-sm uppercase">{{ item.product.name }}</span>
          <span class="font-semibold text-sm">{{ item.price }} $</span>
        </div>
        <div class="border-t mt-8">
          <div class="flex font-semibold justify-between py-6 text-sm uppercase">
            <span>Total cost</span>
            <span>{{ totalPrice }} $</span>
          </div>
          <button @click="handleCheckout()" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout VNPAY</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import ClientService from "../../services/client.service";
import { RouterLink, useRoute } from "vue-router";
import store from "../../store";
import { useToast } from "primevue/usetoast";

const route = useRoute();
const toast = useToast();
const totalPrice = ref(0);
const data = store.getters.getUser;
const carts = ref([]);

onMounted(async () => {
  const response = await ClientService.getCarts();
  carts.value = response.data;
  updateTotalPrice();
});

const updateTotalPrice = () => {
  totalPrice.value = 0;
  carts.value.forEach((item) => {
    totalPrice.value += parseInt(item.price);
  });
};
const handleAddQuantity = async (item) => {
  item.quantity += 1;

  try {
    const response = await ClientService.updateCart(item);
    item.price = item.quantity * item.product.sale_price;
    updateTotalPrice();
    store.dispatch("updateCart", item);
  } catch (error) {
    console.log(error);
  }
};

const handleSubQuantity = async (item) => {
  item.quantity -= 1;
  try {
    const response = await ClientService.updateCart(item);
    item.price = item.quantity * item.product.sale_price;
    updateTotalPrice();
    store.dispatch("updateCart", item);

    if (item.quantity === 0) {
      store.dispatch("removeCart", item);

      carts.value = carts.value.filter((cart) => cart.id !== item.id);
    }
  } catch (error) {
    console.log(error);
  }
};

const handleRemoveCart = async (item) => {
  try {
    const response = await ClientService.removeCart(item.id);
    store.dispatch("removeCart", item);
    updateTotalPrice();
    
    carts.value = carts.value.filter((cart) => cart.id !== item.id);
  } catch (error) {
    console.log(error);
  }
};

const onMessage = (e) => {
  if (e.origin !== "http://localhost:8000" || !e.data.response) {
    return;
  }

  if (e.data.response.vnp_ResponseCode === "00") {
    carts.value = [];
    store.dispatch("removeAllCart");
    
    toast.add({
      severity: "success",
      summary: "Thanh Toán Thành Công",
      detail: e.data.response.message,
      life: 1500,
    });
  }
};

onMounted(() => {
  window.addEventListener("message", onMessage, false);
});

onBeforeUnmount(() => {
  window.removeEventListener("message", onMessage);
});

const handleCheckout = async () => {
  openWindow(`http://localhost:8000/api/vnpay-payment/` + data.data.id, "VNPAY TEST", { width: 500, height: 600 });
};

function openWindow(url, title, options = {}) {
  if (typeof url === "object") {
    options = url;
    url = "";
  }

  options = { url, title, width: 600, height: 720, ...options };

  const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left;
  const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top;
  const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width;
  const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height;

  options.left = width / 2 - options.width / 2 + dualScreenLeft;
  options.top = height / 2 - options.height / 2 + dualScreenTop;

  const optionsStr = Object.keys(options)
    .reduce((acc, key) => {
      acc.push(`${key}=${options[key]}`);
      return acc;
    }, [])
    .join(",");

  const newWindow = window.open(url, title, optionsStr);

  if (window.focus) {
    newWindow.focus();
  }

  return newWindow;
}
</script>
