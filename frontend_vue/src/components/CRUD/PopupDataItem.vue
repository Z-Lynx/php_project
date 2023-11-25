<template>
  <div v-if="isShow" style="z-index: 999" class="pt-10 md:pt-0 inset-0 fixed left-0 right-0 items-center justify-center md:inset-0 h-modal sm:h-full flex bg-gray-900 bg-opacity-50 dark:bg-opacity-80">
    <div class="fixed top-0 right-0 w-full h-screen max-w-xs p-4 transition-transform bg-gray-50 dark:bg-gray-800 transform-none overflow-auto scrollbar-thumb-rounded scrollbar-track-rounded scrollbar-thin scrollbar-thumb-white scrollbar-track-gray-100 dark:scrollbar-thumb-gray-900 dark:scrollbar-track-gray-800">
      <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
        {{ title }}
      </h5>
      <button @click="closePopup()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>

      <form @submit.prevent="submit">
        <div class="relative mb-4" v-for="item in formDataInputs">
          <label :for="item.id" class="">{{ item.label }}</label>
          <input v-model="formData[item.id]" :type="(item.type === 'password' && showPassword ? 'text' : item.type)" :id="item.id" :name="item.id" class="w-full rounded border p-2" />
          <span v-if="isSubmit && !handleErrorForm(item)" class="text-red-500 text-sm">{{ item.error_label }}</span>
          <span v-if="item.type === 'password'" @click="toggleShowPasspord" class="absolute top-9 right-5 cursor-pointer text-gray-400 dark:text-night-300">
            <i v-if="showPassword" class="fa-lg fa-solid fa-eye"></i>
            <i v-else class="fa-lg fa-solid fa-eye-slash"></i>
          </span>
        </div>
        <button type="submit" class="mb-2 w-full rounded bg-green-500 p-2 text-white">
          <div class="flex justify-center items-center" v-if="isLoading">
            <LoadingSpiner />
          </div>
          <div v-else>Create</div>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { watch, ref, onMounted, computed } from "vue";
import LoadingSpiner from "../../components/UI/LoadingSpiner.vue";

const formDataInputs = ref(null);
const isShow = ref(false);
const isCreate = ref(false);
const title = ref("Add User");
const formData = ref({});
const isSubmit = ref(false);
const showPassword = ref(false);

const toggleShowPasspord = () => {
  showPassword.value = !showPassword.value;
};

const props = defineProps(["data"]);
const emit = defineEmits(['submit'])

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
  console.log(data);
  if (data) {
    formDataInputs.value = data.formDataInputs;
    data.formDataInputs.forEach((item) => {
      formData.value[item.id] = "";
    });

    isShow.value = data.isShow;
    isCreate.value = data.isCreate;
    title.value = data.title;
  }
};

const isEmailValid = computed(() => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(formData.value.email);
});

const isPasswordValid = computed(() => {
  return formData.value.password.length >= 6;
});

const isFormValid = computed(() => {
  formDataInputs.value.forEach((item) => {
    if (item.error === "email") {
      if (!isEmailValid.value) {
        return false;
      }
    }
    if (item.error === "password") {
      if (!isPasswordValid.value) {
        return false;
      }
    }
    if (item.error === "confirm_password") {
      if (formData.value.password !== formData.value.password_confirmation) {
        return false;
      }
    }
    if (item.error === "name") {
      if (formData.value.name.length < 3) {
        return false;
      }
    }
    if (item.error === "required") {
      if (formData.value[item.id].length === 0) {
        return false;
      }
    }
  });
  return true;
});

const isRequired = computed((id) => {
  return formData.value[id].length >= 0;
});

const isUsernameValid = computed(() => {
  return formData.value.name.length >= 3;
});

const isConfirmPasswordError = computed(() => {
  return formData.value.password === formData.value.password_confirmation;
});

const handleErrorForm = (field) => {
  switch (field.error) {
    case "email":
      return isEmailValid.value;
    case "password":
      return isPasswordValid.value;
    case "confirm_password":
      return isConfirmPasswordError.value;
    case "name":
      return isUsernameValid.value;
    case "required":
      return isRequired(field.id).value;
    default:
      return false;
  }
};

const submit = () => {
  isSubmit.value = true;
  if (isFormValid.value) {
    emit("submit", formData.value);
  }
};

const closePopup = () => {
  isShow.value = false;
};

</script>
