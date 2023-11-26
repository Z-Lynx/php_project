<template>
  <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center mb-4 sm:mb-0">
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
        >Showing <span class="font-semibold text-gray-900 dark:text-white"> {{ from }} - {{ to }} </span> of <span class="font-semibold text-gray-900 dark:text-white"> {{ total }}</span></span
      >
    </div>
    <div class="flex items-center space-x-3">
      <a v-if="prev_page_url != undefined" :href="prev_page_url" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        Previous
      </a>
      <a v-if="next_page_url != undefined" :href="next_page_url" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        Next
        <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
      </a>
    </div>
  </div>
</template>
<script setup>
import { watch, ref, onMounted } from "vue";

const current_page = ref(null);
const last_page = ref(null);
const next_page_url = ref(null);
const per_page = ref(null);
const prev_page_url = ref(null);
const to = ref(null);
const from = ref(null);
const total = ref(null);

const props = defineProps(["data"]);

onMounted(() => {
  console.log(props.data);
  updateData(props.data);
});

watch(
  () => props.data,
  (newData) => {
    updateData(newData);
  }
);

function updateData(data) {
  if (data) {
    current_page.value = data.current_page;
    last_page.value = data.last_page;
    next_page_url.value = data.next_page_url;
    per_page.value = data.per_page;
    prev_page_url.value = data.prev_page_url;
    to.value = data.to;
    from.value = data.from;
    total.value = data.total;

    if (next_page_url.value != null) {
      next_page_url.value = window.location.href.split("?")[0] + "?" + next_page_url.value.split("?")[1];
    }

    if (prev_page_url.value != null) {
      prev_page_url.value = window.location.href.split("?")[0] + "?" + prev_page_url.value.split("?")[1];
    }
  }
}
</script>
