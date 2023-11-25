<template>
  <div v-if="show" style="z-index: 999" class="pt-10 md:pt-0 inset-0 fixed left-0 right-0 items-center justify-center md:inset-0 h-modal sm:h-full flex bg-gray-900 bg-opacity-50 dark:bg-opacity-80">
    <div class="flex justify-center">
      <div class="bg-white p-4 shadow-lg rounded-lg dark:bg-gray-900">
        <h2 class="flex justify-center text-xl font-semibold mb-2">Are you sure for</h2>
        <h2 class="flex justify-center text-xl font-semibold mb-2">Delete</h2>
        <div class="py-2"></div>
        <div class="flex items-center space-x-5">
          <button @click="handleCancel" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cancel</button>
          <button @click="handleDelete" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { watch, ref, onMounted, computed } from "vue";

const props = defineProps(["data"]);
const emit = defineEmits(["choose"]);
const show = ref(false);
const dataItem = ref(null);

onMounted(() => {
  console.log(props);
  updateData(props.data);
});

watch(
  () => props.data,
  (newData) => {
    updateData(newData);
  }
);

const updateData = (data) => {
  show.value = data.isShow;
  dataItem.value = data.dataItem;
};

const toggle = () => (show.value = !show.value);

const handleCancel = () => {
  emit("choose", { isDelete: false });
  toggle();
};

const handleDelete = () => {
  emit("choose", { isDelete: true, dataItem: dataItem.value });
  toggle();
};
</script>
