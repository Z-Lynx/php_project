
<template>
    <div class="admin-layout">
        <nav class="sidebar">
            <button @click="open = !open" class="btn-dropdow-link">Management</button>
            <ul v-if="open">
                <li class="link-nav"><router-link to="/admin/category">Category</router-link></li>
                <li class="link-nav"><router-link to="/admin/user">User</router-link></li>
                <li class="link-nav"><router-link to="/admin/product">Product</router-link></li>
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
            open: false
        }
    }
}
</script>

<style>
.admin-layout {
    padding-top: 50px;
    display: flex;

}

.sidebar {


    width: 200px;
    padding: 20px;
    background-color: #c1c1c1;
    color: rgb(0, 0, 0);

}

.btn-dropdow-link {
    padding: 10px;

    background-color: rgb(133, 133, 133);
}

.link-nav {

    padding: 10px;

    background-color: rgb(186, 186, 186);

}

.content {
    padding: 20px;

    margin-left: 20px;

}
</style>
  
  