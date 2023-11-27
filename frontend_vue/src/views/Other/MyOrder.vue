<template>
  <div class="container flex flex-col min-h-screen">
    <h1 class="border-b py-6 text-4xl font-semibold">History Order</h1>
    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th scope="col" class="p-4">
            <div class="flex items-center">
              <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
              <label for="checkbox-all" class="sr-only">checkbox</label>
            </div>
          </th>
          <th v-for="item in columns" scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
            {{ item }}
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
        <tr v-for="item in orderHistory" class="hover:bg-gray-100 dark:hover:bg-gray-700">
          <td class="w-4 p-4">
            <div class="flex items-center">
              <input :id="item.id" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
              <label :for="item.id" class="sr-only">checkbox</label>
            </div>
          </td>
          <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ item.vn_pay_code }}
          </td>
          <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ item.product_id }}
          </td>
          <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ item.quantity }}
          </td>
          <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ item.total_amount }}
          </td>
          <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ item.status }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import clientService from "../../services/client.service";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const orderHistory = ref([]);
const columns = ["VN_PAY_CODE", "Product", "Quantity", "Total amount", "Status"];

onMounted(async () => {
  try {
    const response = await clientService.getMyOrder();
    orderHistory.value = response.data;
  } catch (error) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: error.message,
      life: 3000,
    });
  }
});
</script>
