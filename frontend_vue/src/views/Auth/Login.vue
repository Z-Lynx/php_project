<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-96 rounded bg-white p-8 shadow-md">
      <h2 class="mb-6 text-2xl font-semibold">Login</h2>

      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="phone" class="mb-2 block text-sm text-gray-600">Email</label>
          <input v-model="formData.email" type="tel" id="phone" name="phone" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isEmailValid" class="text-red-500 text-sm">Please enter a valid email address.</span>
        </div>

        <div class="mb-4">
          <label for="password" class="mb-2 block text-sm text-gray-600">Password</label>
          <input v-model="formData.password" type="password" id="password" name="password" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isPasswordValid" class="text-red-500 text-sm">Password must be at least 6 characters long.</span>
        </div>

        <button type="submit" class="w-full rounded bg-green-500 p-2 text-white">Login</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isSumbit: false,
      formData: {
        email: "",
        password: "",
      },
    };
  },
  computed: {
    isEmailValid() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(this.formData.email);
    },
    isPasswordValid() {
      return this.formData.password.length >= 6;
    },
    isFormValid() {
      return this.isEmailValid && this.isPasswordValid;
    },
  },
  methods: {
    login() {
      this.isSumbit = true;
      if (this.isFormValid) {
        console.log("Login:", this.formData);
      }
    },
  },
};
</script>
