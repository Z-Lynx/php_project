<template>
  <div class="h-[90vh] bg-gray-50">
    <div class="flex flex-col items-center justify-center w-full">
      <div class="text-lg font-semibold mt-5">Send Notifications</div>
      <form class="max-w-[400px] w-full" @submit.prevent="submit">
        <div class="mb-4">
          <label for="user_id" class="">User</label>
          <Dropdown v-model="formData.user_id" :options="dataSelect" optionLabel="name" optionValue="id" placeholder="Select" class="w-full" />
          <span v-if="isSubmit && !formData.user_id === ''" class="text-red-500 text-sm">Need to choose</span>
        </div>

        <div class="mb-4">
          <label for="phone" class="mb-2 block text-sm text-gray-600">Data Notification</label>
          <textarea v-model="formData.data" class="w-full rounded border p-2" rows="10"></textarea>
          <span v-if="isSumbit && formData.data === ''" class="text-red-500 text-sm">Need to require</span>
        </div>

        <button type="submit" class="mb-2 w-full rounded bg-green-500 p-2 text-white">
          <div class="flex justify-center items-center" v-if="isLoading">
            <LoadingSpiner />
          </div>
          <div v-else>Send</div>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import UsersService from "../../services/user.service";
import { useToast } from "primevue/usetoast";
import LoadingSpiner from "../../components/UI/LoadingSpiner.vue";

const toast = useToast();

const formData = ref({
  user_id: "",
  data: "",
});
const dataSelect = ref([]);
const isSubmit = ref(false);
const isLoading = ref(false);

onMounted(async () => {
  try {
    const users = await UsersService.getUsers();
    const dataUsers = users.data.filter((item) => {
      if (item.fcm_id) {
        return item;
      }
    });
    dataSelect.value = dataUsers;
  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: err.message,
      life: 1500,
    });
  }
});

const submit = async () => {
  isSubmit.value = true;
  if (formData.value.user_id === "" || formData.value.data === "") {
    return;
  }
  isLoading.value = true;
  try{
    const res = await UsersService.sendNotification(formData.value);
    toast.add({
      severity: "success",
      summary: "Success",
      detail: res.message,
      life: 1500,
    });
    formData.value = {
      user_id: "",
      data: "",
    };
  }
  catch(err){
    toast.add({
      severity: "error",
      summary: "Error",
      detail: err.message,
      life: 1500,
    });
  }
  isLoading.value = false;
};
</script>
