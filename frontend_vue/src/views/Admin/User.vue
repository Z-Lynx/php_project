<template>
  <div class="m-10">
    <div class="flex justify-between items-center mb-4">
      <p class="text-xl font-bold">User management</p>
      <button class="bg-green-500 text-white py-2 px-4 rounded cursor-pointer">Add user</button>
    </div>
    <table class="w-full border-collapse border">
      <thead>
        <tr>
          <th class="border py-2 px-4">ID</th>
          <th class="border py-2 px-4">username</th>
          <th class="border py-2 px-4">password</th>
          <th class="border py-2 px-4">numberPhone</th>
          <th class="border py-2 px-4">firstName</th>
          <th class="border py-2 px-4">lastName</th>
          <th class="border py-2 px-4">ID Facebook</th>
          <th class="border py-2 px-4">ID Gmail</th>
          <th class="border py-2 px-4">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td class="border py-2 px-4 text-center">{{ user.id }}</td>
          <td class="border py-2 px-4 text-center">{{ user.username }}</td>
          <td class="border py-2 px-4 text-center">{{ user.password }}</td>
          <td class="border py-2 px-4 text-center">{{ user.phonenumber }}</td>
          <td class="border py-2 px-4 text-center">{{ user.firstName }}</td>
          <td class="border py-2 px-4 text-center">{{ user.lastName }}</td>
          <td class="border py-2 px-4 text-center">{{ user.idFacebook }}</td>
          <td class="border py-2 px-4 text-center">{{ user.idGmail }}</td>
          <td class="border py-2 px-4 text-center">
            <button @click="deleteUser(user.id)"
              class="bg-red-500 text-white py-2 px-4 rounded cursor-pointer">Delete</button>
            <button @click="editUser(user.id)"
              class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer ml10">Update</button>
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
