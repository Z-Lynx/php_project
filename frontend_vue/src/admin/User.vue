<template>
    <div>
        <div class="add-data">
            <p>User management</p>
            <button class="btn-add">Add user</button>
        
        </div>
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>username</th>
            <th>password</th>
            <th>numberPhone</th>
            <th>firstName</th>
            <th>lastName</th>
            <th>ID Facebook</th>
            <th>ID Gmail</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.password }}</td>
            <td>{{ user.phonenumber }}</td>
            <td>{{ user.firstName }}</td>
            <td>{{ user.lastName }}</td>
            <td>{{ user.idFacebook }}</td>
            <td>{{ user.idGmail }}</td>
            <td>
              <button @click="deleteUser(user.id)" class="btn-delete">Delete</button>
              <button @click="editUser(user.id)" class="btn-update">Update</button>
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
        users: [
          {
            id: 1,
            username: "user1",
            password: "password1",
            phonenumber: "123456789",
            firstName: "First",
            lastName: "Last",
            idFacebook: "facebook1",
            idGmail: "gmail1",
          },
          {
            id: 2,
            username: "user2",
            password: "password2",
            phonenumber: "987654321",
            firstName: "First",
            lastName: "Last",
            idFacebook: "facebook2",
            idGmail: "gmail2",
          },
          // Thêm dữ liệu User khác ở đây
        ],
      };
    },
    methods: {
      deleteUser(id) {
        // Xử lý xóa User với ID là id
        console.log(`Xóa User với ID ${id}`);
      },
      editUser(id) {
        // Xử lý cập nhật User với ID là id
        console.log(`Cập nhật User với ID ${id}`);
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
  
  .btn-delete,
  .btn-update {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 5px 10px;
    margin-right: 5px;
    cursor: pointer;
  }
  
  .btn-update {
    background-color: #3498db;
  }
  </style>
  