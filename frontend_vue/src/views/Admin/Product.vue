<template>
  <div class="m-10">
    <div class="flex justify-between items-center mb-4">
      <p class="text-xl font-bold">Product management</p>
      <button class="bg-green-500 text-white py-2 px-4 rounded cursor-pointer">Add product</button>
    </div>
    <table class="w-full border-collapse border">
      <thead>
        <tr>
          <th class="border py-2 px-4">ID</th>
          <th class="border py-2 px-4">Product Name</th>
          <th class="border py-2 px-4">Category</th>
          <th class="border py-2 px-4">Price</th>
          <th class="border py-2 px-4">Discount</th>
          <th class="border py-2 px-4">Quality Inventory</th>
          <th class="border py-2 px-4">Description</th>
          <th class="border py-2 px-4">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td class="border py-2 px-4 text-center">{{ product.id }}</td>
          <td class="border py-2 px-4 text-center">{{ product.productName }}</td>
          <td class="border py-2 px-4 text-center">{{ product.category }}</td>
          <td class="border py-2 px-4 text-center">{{ product.price }}</td>
          <td class="border py-2 px-4 text-center">{{ product.discount }}<span class="text-gray-500">%</span></td>
          <td class="border py-2 px-4 text-center">{{ product.quality }}</td>
          <td class="border py-2 px-4 text-center">{{ product.description }}</td>
          <td class="border py-2 px-4 text-center">
            <button @click="deleteProduct(product.id)"
              class="bg-red-500 text-white py-2 px-4 rounded cursor-pointer">Delete</button>
            <button @click="editProduct(product.id)"
              class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer ml-10">Update</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [
        {
          id: 1,
          productName: "Sản phẩm 1",
          category: "Danh mục 1",
          price: 100,
          discount: 10,
          quality: 50,
          description: "Mô tả sản phẩm 1",
        },
        {
          id: 2,
          productName: "Sản phẩm 2",
          category: "Danh mục 2",
          price: 200,
          discount: 20,
          quality: 40,
          description: "Mô tả sản phẩm 2",
        },
        // Thêm dữ liệu sản phẩm khác ở đây
      ],
    };
  },
  methods: {
    deleteProduct(id) {
      // Xử lý xóa sản phẩm với ID là id
      console.log(`Xóa sản phẩm với ID ${id}`);
    },
    editProduct(id) {
      // Xử lý cập nhật sản phẩm với ID là id
      console.log(`Cập nhật sản phẩm với ID ${id}`);
    },
  },
};
</script>
