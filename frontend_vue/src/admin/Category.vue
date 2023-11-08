<template>
    <div>
        <div class="add-data">
            <p>Category management</p>
            <button class="btn-add">Add category</button>

        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>categoryName</th>
                    <th>description</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.idCategory }}</td>
                    <td>{{ category.categoryName }}</td>
                    <td>{{ category.description }}</td>
                    <td>
                        <button @click="deleteCategory(category.idCategory)" class="btn-delete">Delete</button>
                        <button @click="editCategory(category.idCategory)" class="btn-update">Update</button>
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
            categories: [
                { idCategory: 1, categoryName: "Category 1", description: "Mô tả Category 1" },
                { idCategory: 2, categoryName: "Category 2", description: "Mô tả Category 2" },
                // Thêm dữ liệu Category khác ở đây
            ],
        };
    },
    methods: {
        deleteCategory(idCategory) {
            // Xử lý xóa Category với ID là idCategory
            console.log(`Xóa Category với ID ${idCategory}`);
        },
        editCategory(idCategory) {
            // Xử lý cập nhật Category với ID là idCategory
            console.log(`Cập nhật Category với ID ${idCategory}`);
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
  