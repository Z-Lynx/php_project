<template>
  <main>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
      <div class="w-full mb-1">
        <Breadcrumb header="All Bills" breadCrumb="Bills" link="bills" />
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
            <button @click="showAdd" type="button" data-modal-toggle="add-user-modal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
              Add bills
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
                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.vn_pay_code }}
                  </td>
                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ item.user_id }}
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
                  <td class="p-4 space-x-2 whitespace-nowrap">
                    <button @click="showEdit(item)" type="button" data-modal-toggle="edit-user-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                      <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                      </svg>
                      Edit
                    </button>
                    <button @click="showDel(item)" type="button" data-modal-toggle="delete-user-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
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
import { onMounted, ref } from "vue";
import BillsServices from "../../services/bills.service";
import UserServices from "../../services/user.service";
import ProductsServices from "../../services/products.service";
import { useToast } from "primevue/usetoast";
import { useRoute } from "vue-router";
import PopupDataItem from "../../components/CRUD/PopupDataItem.vue";
import DelItem from "../../components/CRUD/DelItem.vue";

const toast = useToast();

const columns = ["VN_PAY_CODE", "User", "Product", "Quantity", "Total amount", "Status", "Action"];
const data = ref([]);
const dataPaginated = ref({});
const route = useRoute();
const page = ref(route.query.page || 1);

const dataPopUpItem = ref({
  formDataInputs: [],
  isShow: false,
  isCreate: false,
  title: "",
  dataSelect: [],
  dataSelect2: [],
});

const dataPopUpDelete = ref({
  isShow: false,
  dataItem: {},
});

const formDataInputs = [
  {
    id: "user_id",
    label: "User",
    type: "select",
    error_label: "Need to require name.",
    error: "required",
  },
  {
    id: "product_id",
    label: "Product",
    type: "select",
    error_label: "Need to require slug.",
    error: "required",
  },
  {
    id: "quantity",
    label: "Quantity",
    type: "number",
    error_label: "Need to require quanity.",
    error: "required",
  },
  {
    id: "total_amount",
    label: "Total amount",
    type: "number",
    error_label: "Need to require total mmout.",
    error: "required",
  },
  {
    id: "status",
    label: "Status",
    type: "select",
    error_label: "Need to require status.",
    error: "required",
    dataSelect: [
      {
        id: "thanh_toan_thanh_cong",
        name: "thanh_toan_thanh_cong",
      },
      {
        id: "dang_giao_hang",
        name: "dang_giao_hang",
      },
      {
        id: "da_nhan",
        name: "da_nhan",
      },
    ],
  },
];

const showAdd = () => {
  dataPopUpItem.value = {
    formDataInputs: formDataInputs,
    isShow: true,
    isCreate: true,
    title: "Add bill",
    dataSelect: [],
  };
};

const showEdit = (item) => {
  dataPopUpItem.value = {
    formDataInputs: formDataInputs,
    isShow: true,
    isCreate: false,
    title: "Edit bill",
    dataItem: item,
    dataSelect: [],
    dataSelect2: [],
  };
};

const showDel = (item) => {
  dataPopUpDelete.value = {
    isShow: true,
    dataItem: item,
  };
};

onMounted(async () => {
  try {
    const bills = await BillsServices.getBills();
    const users = await UserServices.getUsers();
    const products = await ProductsServices.getProducts();

    formDataInputs.find((item) => item.id === "user_id").dataSelect = users.data;
    formDataInputs.find((item) => item.id === "product_id").dataSelect = products.data;

    data.value = bills.data;
    dataPaginated.value = bills.pagination;
  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: err.message,
      life: 1500,
    });
  }
});

const callback = async (dataCallBack) => {
  try {
    if (dataPopUpItem.value.isCreate) {
      const bill = await BillsServices.createBill(dataCallBack);
      data.value.push(bill.data);
      toast.add({
        severity: "success",
        summary: "Success",
        detail: "Create bill success",
        life: 1500,
      });
    } else {
      const bill = await BillsServices.updateBill(dataCallBack);
      data.value = data.value.map((item) => {
        if (item.id === bill.data.id) {
          return bill.data;
        }
        return item;
      });

      toast.add({
        severity: "success",
        summary: "Success",
        detail: "Update bill success",
        life: 1500,
      });
    }
  } catch (err) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: err.message,
      life: 1500,
    });
  }
  dataPopUpItem.value = {
    formDataInputs: [],
    isShow: false,
    isCreate: false,
    title: "",
  };
};

const callbackChoose = (choose) => {
  if (choose) {
    try {
      BillsServices.deleteBill(dataPopUpDelete.value.dataItem.id);
      data.value = data.value.filter((item) => item.id !== dataPopUpDelete.value.dataItem.id);
      toast.add({
        severity: "success",
        summary: "Success",
        detail: "Delete bill success",
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
