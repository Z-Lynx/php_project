<template>
  <main>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
      <div class="w-full mb-1">
        <Breadcrumb header="All users" breadCrumb="User" link="users" />
        <div class="sm:flex">
          <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
            <form class="lg:pr-3" action="#" method="GET">
              <label for="users-search" class="sr-only">Search</label>
              <div class="relative mt-1 lg:w-64 xl:w-96">
                <input type="text" name="email" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for users" />
              </div>
            </form>
            <div class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0">
              <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
              </a>
              <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
              </a>
              <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
              </a>
              <a href="#" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
              </a>
            </div>
          </div>
          <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
            <button @click="showAddUser" type="button" data-modal-toggle="add-user-modal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
              Add user
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
          <div class="overflow-hidden shadow">
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
                <tr v-for="item in data" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                  <td class="w-4 p-4">
                    <div class="flex items-center">
                      <input :id="item.id" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
                      <label :for="item.id" class="sr-only">checkbox</label>
                    </div>
                  </td>
                  <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                    <img class="w-10 h-10 rounded-full" :src="item.avatar" />
                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                      <div class="text-base font-semibold text-gray-900 dark:text-white">{{ item.name }}</div>
                      <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ item.email }}</div>
                    </div>
                  </td>
                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.is_active }}
                  </td>
                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.is_admin }}
                  </td>
                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.auth_type }}
                  </td>
                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.updated_at }}
                  </td>
                  <td class="p-4 space-x-2 whitespace-nowrap">
                    <button @click="showEditUser(item)" type="button" data-modal-toggle="edit-user-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                      <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                      </svg>
                      Edit
                    </button>
                    <button @click="showDelete(item)" type="button" data-modal-toggle="delete-user-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                      <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <PopupDataItem :data="dataPopUpItem" @submit="callback" />
    <DelItem :data="dataPopUpDelete" @choose="callbackChoose" />
  </main>
</template>

<script setup>
import Breadcrumb from "../../components/UI/Breadcrumb.vue";
import Paging from "../../components/UI/Paging.vue";
import PopupDataItem from "../../components/CRUD/PopupDataItem.vue";
import DelItem from "../../components/CRUD/DelItem.vue";
import { onMounted, ref } from "vue";
import UsersService from "../../services/user.service";
import { useToast } from "primevue/usetoast";
import { useRoute } from "vue-router";

const toast = useToast();
const dataPopUpItem = ref({
  formDataInputs: [],
  isShow: false,
  isCreate: false,
  title: "",
  dataSelect: [],
});

const dataPopUpDelete = ref({
  isShow: false,
  dataItem: {},
});

const formDataEditInputs = [
  {
    id: "name",
    label: "Name",
    type: "text",
    error_label: "Username must be at least 3 characters long.",
    error: "name",
  },
  {
    id: "email",
    label: "Email",
    type: "email",
    error_label: "Email must be valid.",
    error: "email",
  },
];

const formDataInputs = [
  {
    id: "name",
    label: "Name",
    type: "text",
    error_label: "Username must be at least 3 characters long.",
    error: "name",
  },
  {
    id: "email",
    label: "Email",
    type: "email",
    error_label: "Email must be valid.",
    error: "email",
  },
  {
    id: "password",
    label: "Password",
    type: "password",
    error_label: "Password must be at least 6 characters long.",
    error: "password",
  },
  {
    id: "password_confirmation",
    label: "Password Confirmation",
    type: "password",
    error_label: "Passwords do not match.",
    error: "confirm_password",
  },
];

const columns = ["name", "is_active", "is_admin", "auth_type", "updated_at", "actions"];
const data = ref([]);
const dataPaginated = ref({});
const route = useRoute();

const page = ref(route.query.page || 1);

onMounted(async () => {
  try {
    const users = await UsersService.getUsers(page.value);
    data.value = users.data;
    dataPaginated.value = users.pagination;
  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: err.message,
      life: 1500,
    });
  }
});

const showAddUser = () => {
  dataPopUpItem.value = {
    formDataInputs: formDataInputs,
    isShow: true,
    isCreate: true,
    title: "Add User",
    dataSelect: [],
  };
};

const showEditUser = (item) => {
  dataPopUpItem.value = {
    formDataInputs: formDataEditInputs,
    isShow: true,
    isCreate: false,
    title: "Edit User",
    dataItem: item,
    dataSelect: [],
  };
};

const callback = async (dataCallBack) => {
  if (dataPopUpItem.value.isCreate) {
    try {
      const user = await UsersService.createUser(dataCallBack);
      data.value.push(user.data);
      toast.add({
        severity: "success",
        summary: "Success",
        detail: "User created successfully",
        life: 1500,
      });
    } catch (err) {
      toast.add({
        severity: "error",
        summary: "Error",
        detail: err.message,
        life: 1500,
      });
    }
  } else {
    try {
      const user = await UsersService.updateUser(dataCallBack);
      data.value.map((item) => {
        if (item.id === user.data.id) {
          item = user.data;
        }
      });
      toast.add({
        severity: "success",
        summary: "Success",
        detail: "User updated successfully",
        life: 1500,
      });
    } catch (err) {
      toast.add({
        severity: "error",
        summary: "Error",
        detail: err.message,
        life: 1500,
      });
    }
  }

  dataPopUpItem.value = {
    formDataInputs: [],
    isShow: false,
    isCreate: false,
    title: "Edit User",
    dataItem: [],
    dataSelect: [],
  };
};

const showDelete = (item) => {
  dataPopUpDelete.value = {
    isShow: true,
    dataItem: item,
  };
};

const callbackChoose = (choose) => {
  if (choose.isDelete) {
    console.log(choose.dataItem);
    try {
      UsersService.deleteUser(choose.dataItem.id);
      data.value = data.value.filter((item) => item.id !== choose.dataItem.id);
      toast.add({
        severity: "success",
        summary: "Success",
        detail: "User deleted successfully",
        life: 1500,
      });
    } catch (err) {
      toast.add({
        severity: "error",
        summary: "Error",
        detail: err.message,
        life: 1500,
      });
    }
  }
  dataPopUpDelete.value = {
    isShow: false,
    dataItem: {},
  };
};
</script>
