<template>
  <div class="flex min-h-screen items-center justify-center bg-gray-50">
    <div class="w-96 rounded bg-white p-8 shadow-md">
      <h2 class="mb-6 text-2xl font-semibold">Register</h2>

      <form @submit.prevent="register">
        <div class="mb-4">
          <label for="username" class="mb-2 block text-sm text-gray-600">Username</label>
          <input v-model="formData.username" type="text" id="username" name="username" class="w-full rounded border p-2" />
        </div>

        <div class="mb-4">
          <label for="password" class="mb-2 block text-sm text-gray-600">Password</label>
          <input v-model="formData.password" type="password" id="password" name="password" class="w-full rounded border p-2" />
        </div>

        <div class="mb-4">
          <label for="confirmPassword" class="mb-2 block text-sm text-gray-600">Confirm Password</label>
          <input v-model="formData.confirmPassword" type="password" id="confirmPassword" name="confirmPassword" class="w-full rounded border p-2" />
        </div>

        <div class="mb-4">
          <label for="phone" class="mb-2 block text-sm text-gray-600">Phone Number</label>
          <input v-model="formData.phoneNumber" type="tel" id="phone" name="phone" class="w-full rounded border p-2" />
        </div>

        <button type="submit" class="w-full rounded bg-blue-500 p-2 text-white">Register</button>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        formData: {
          username: '',
          password: '',
          confirmPassword: '',
          phoneNumber: '',
        },
      };
    },
    methods: {
      register() {
        console.log('Registering:', this.formData);
      },
    },
  };
</script>

<style scoped>
</style>