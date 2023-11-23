<template>
    <div class="m-10">
        <div class="flex justify-between items-center mb-4 ">
            <p class="text-xl font-semibold">Category management</p>
            <button class="bg-green-500 text-white py-2 px-4 rounded cursor-pointer">Add category</button>
        </div>
        <table class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border py-2 px-4">ID</th>
                    <th class="border py-2 px-4">categoryName</th>
                    <th class="border py-2 px-4">description</th>
                    <th class="border py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.idCategory">
                    <td class="border py-2 px-4 text-center">{{ category.idCategory }}</td>
                    <td class="border py-2 px-4 text-center">{{ category.categoryName }}</td>
                    <td class="border py-2 px-4 text-center">{{ category.description }}</td>
                    <td class="border py-2 px-4 text-center">
                        <button @click="deleteCategory(category.idCategory)"
                            class="bg-red-500 text-white py-2 px-4 rounded cursor-pointer">Delete</button>
                        <button @click="editCategory(category.idCategory)"
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
  