<template>
  <div>
    <div class="add-data">
      <p>Product management</p>
      <button class="btn-add">Add product</button>

    </div>
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>productName</th>
          <th>category</th>
          <th>price</th>
          <th>discount</th>
          <th>qualityInventory</th>
          <th>description</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.id }}</td>
          <td>{{ product.productName }}</td>
          <td>{{ product.category }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.discount }}<span>%</span></td>
          <td>{{ product.quality }}</td>
          <td>{{ product.description }}</td>
          <td>
            <button @click="deleteProduct(product.id)" class="btn-delete">Delete</button>
            <button @click="editProduct(product.id)" class="btn-update">Update</button>
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

<style>
.admin-table {
  width: 100%;
  border-collapse: collapse;
}

.admin-table th,
.admin-table td {
  border: 1px solid #ddd;
  padding: 8px;
}

.btn-delete,
.btn-update {
  background-color: #e74c3c;
  color: white;
  border: none;
  padding: 5px 10px;
  margin-right: 5px;
  cursor: pointer;
}
.add-data{
    
    display:flex;
    justify-content: space-between;
  }
  .btn-add{
    background-color: rgb(0, 99, 0);
    color: white;
    cursor: pointer;
    padding: 5px 10px;
   margin-bottom: 5px;
  }

.btn-update {
  background-color: #3498db;
}
</style>
