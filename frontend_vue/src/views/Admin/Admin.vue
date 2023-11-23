<template>
    <div class="admin-layout m-10">
        <h1 class="text-center text-3xl font-bold">ADMIN</h1>
        <nav class="sidebar">
            <button @click="open = !open"
                class="btn-dropdow-link bg-gray-500 text-white py-2 px-4 rounded cursor-pointer">Management</button>
            <ul v-if="open">
                <router-link to="/admin/category" >
                    <li class="link-nav hover:bg-gray-500 hover:text-white bg-gray-300 py-2 px-4 block">Category</li>
                </router-link>
                <router-link to="/admin/product" >
                    <li class="link-nav hover:bg-gray-500 hover:text-white bg-gray-300 py-2 px-4 block">Product</li>
                </router-link>
                <router-link to="/admin/user" >
                    <li class="link-nav hover:bg-gray-500 hover:text-white bg-gray-300 py-2 px-4 block">User</li>
                </router-link>
            </ul>
        </nav>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            open: false,
        };
    },
};
</script>
  