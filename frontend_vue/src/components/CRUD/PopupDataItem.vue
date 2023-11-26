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

      <form @submit.prevent="submit" class="flex flex-col h-[90vh]">
        <div class="grow">
          <div class="relative mb-4" v-for="item in formDataInputs">
            <div v-if="item.type === 'image'">
              <label :for="item.id" class="">{{ item.label }}</label>
              <div class="flex items-center space-x-6">
                <div class="h-16 w-16">
                  <img :src="imageSrc" id="preview_img" class="h-16 w-16 object-cover rounded-full" alt="Business photo" />
                </div>
                <input v-on:change="handleChangeImage($event)" :id="item.id" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
              </div>
              <span v-if="isSubmit && !handleErrorForm(item)" class="text-red-500 text-sm">{{ item.error_label }}</span>
            </div>

            <div v-if="item.type === 'select'">
              <label :for="item.id" class="">{{ item.label }}</label>
              <Dropdown v-model="formData[item.id]" :options="dataSelect.length === 0 ? item.dataSelect : dataSelect" optionLabel="name" optionValue="id" placeholder="Select" class="w-full" />
              <span v-if="isSubmit && !handleErrorForm(item)" class="text-red-500 text-sm">{{ item.error_label }}</span>
            </div>

            <div v-if="item.type !== 'image' && item.type !== 'select'">
              <label :for="item.id" class="">{{ item.label }}</label>
              <input v-model="formData[item.id]" :type="item.type === 'password' && showPassword ? 'text' : item.type" :id="item.id" :name="item.id" class="w-full rounded border p-2" />
              <span v-if="isSubmit && !handleErrorForm(item)" class="text-red-500 text-sm">{{ item.error_label }}</span>
              <span v-if="item.type === 'password'" @click="toggleShowPasspord" class="absolute top-9 right-5 cursor-pointer text-gray-400 dark:text-night-300">
                <i v-if="showPassword" class="fa-lg fa-solid fa-eye"></i>
                <i v-else class="fa-lg fa-solid fa-eye-slash"></i>
              </span>
            </div>
          </div>
        </div>
        <button type="submit" class="mb-2 w-full rounded bg-green-500 p-2 text-white">
          <div class="flex justify-center items-center" v-if="isLoading">
            <LoadingSpiner />
          </div>
          <div v-else>{{ isCreate ? "Create" : "Edit" }}</div>
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
const isFormKey = ref("");
const isSubmit = ref(false);
const isLoading = ref(false);
const dataItem = ref(null);
const setSlug = ref(true);
const dataSelect = ref([]);
const imageSrc = ref("");
const showPassword = ref(false);

const toggleShowPasspord = () => {
  showPassword.value = !showPassword.value;
};

const props = defineProps(["data"]);
const emit = defineEmits(["submit"]);
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

watch(
  () => formData.value.name,
  (newName) => {
    if (formData.value.hasOwnProperty("slug") && setSlug) {
      formData.value.slug = handleSlug(newName);
    }
  }
);

const updateData = (data) => {
  isLoading.value = false;
  imageSrc.value = "";

  if (data) {
    formDataInputs.value = data.formDataInputs;
    isShow.value = data.isShow;
    isCreate.value = data.isCreate;
    title.value = data.title;
    dataItem.value = data.dataItem;
    dataSelect.value = data.dataSelect;
  }

  console.log(dataSelect);
  if (!isCreate.value) {
    setSlug.value = false;
    formDataInputs.value.forEach((item) => {
      formData.value[item.id] = data.dataItem[item.id];
    });
    if (formData.value.hasOwnProperty("image")) {
      imageSrc.value = formData.value.image;
    }

    console.log("select");
    formDataInputs.value.forEach((item) => {
      if (item.type === "select" && dataSelect.value.length > 0) {
        const dataTemp = dataSelect.value.find((itemDataSelect) => {
          return itemDataSelect.slug === data.dataItem[item.id];
        });
        formData.value[item.id] = dataTemp.id;
      }

      if (item.dataSelect !== null && item.dataSelect !== undefined && item.type === "select" && item.dataSelect.length > 0) {
        const dataTemp = item.dataSelect.find((itemDataSelect) => {
          return itemDataSelect.name === data.dataItem[item.id];
        });
        console.log(data.dataItem[item.id]);

        formData.value[item.id] = dataTemp.id;
      }
    });
  } else {
    data.formDataInputs.forEach((item) => {
      formData.value[item.id] = "";
    });
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
  return !formDataInputs.value.some((item) => {
    switch (item.error) {
      case "email":
        return !isEmailValid.value;
      case "password":
        return !isPasswordValid.value;
      case "confirm_password":
        return formData.value.password !== formData.value.password_confirmation;
      case "name":
        return formData.value.name.length < 3;
      case "required":
        return formData.value[item.id] === "";
      default:
        return false;
    }
  });
});

const isRequired = computed(() => {
  return formData.value[isFormKey.value] === "" ? false : true;
});

const isUsernameValid = computed(() => {
  return formData.value.name.length >= 3;
});

const isConfirmPasswordError = computed(() => {
  return formData.value.password === formData.value.password_confirmation;
});

const handleChangeImage = (e) => {
  console.log(e);
  const file = e.target.files[0];
  console.log(file);
  formData.value.image = file;
  imageSrc.value = URL.createObjectURL(file);
};

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
      isFormKey.value = field.id;
      return isRequired.value;
    default:
      return false;
  }
};

const submit = () => {
  isSubmit.value = true;

  if (isFormValid.value) {
    isLoading.value = true;
    if (isCreate.value) {
      emit("submit", formData.value);
    } else {
      formDataInputs.value.forEach((item) => {
        if (formData.value[item.id]) {
          dataItem.value[item.id] = formData.value[item.id];
        }
      });
      emit("submit", dataItem.value);
    }
    isSubmit.value = false;
  }
};

const handleSlug = (value) => {
  return value.trim().toLowerCase().replace(/\s+/g, "-");
};

const closePopup = () => {
  isShow.value = false;
};
</script>
