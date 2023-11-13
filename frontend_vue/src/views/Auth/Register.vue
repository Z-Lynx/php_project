<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-96 rounded bg-white p-8 shadow-md">
      <h2 class="mb-6 text-2xl font-semibold">Register</h2>

      <form @submit.prevent="register">
        <div class="mb-4">
          <label for="email" class="mb-2 block text-sm text-gray-600">Email</label>
          <input v-model="formData.email" type="email" id="email" name="email" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isEmailValid" class="text-red-500 text-sm">Please enter a valid email address.</span>
        </div>

        <div class="mb-4">
          <label for="username" class="mb-2 block text-sm text-gray-600">Username</label>
          <input v-model="formData.username" type="text" id="username" name="username" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isUsernameValid" class="text-red-500 text-sm">Username must be at least 3 characters long.</span>
        </div>

        <div class="mb-4">
          <label for="password" class="mb-2 block text-sm text-gray-600">Password</label>
          <input v-model="formData.password" type="password" id="password" name="password" class="w-full rounded border p-2" />
          <span v-if="isSumbit && !isPasswordValid" class="text-red-500 text-sm">Password must be at least 6 characters long.</span>
        </div>

        <div class="mb-4">
          <label for="confirmPassword" class="mb-2 block text-sm text-gray-600">Confirm Password</label>
          <input v-model="formData.password_confirmation" type="password" id="confirmPassword" name="confirmPassword" class="w-full rounded border p-2" />
          <span v-if="isSumbit &&  !isPasswordValid  || (formData.password !== formData.password_confirmation)" class="text-red-500 text-sm">Passwords do not match.</span>
        </div>

        <button type="submit" class="w-full rounded bg-green-500 p-2 text-white">Register</button>
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
        username: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  computed: {
    isEmailValid() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(this.formData.email);
    },
    isUsernameValid() {
      return this.formData.username.length >= 3;
    },
    isPasswordValid() {
      return this.formData.password.length >= 6;
    },
    isFormValid() {
      return this.isEmailValid && this.isUsernameValid && this.isPasswordValid && this.formData.password === this.formData.password_confirmation;
    },
  },
  methods: {
    register() {
      this.isSumbit = true;
      if (this.isFormValid) {
        console.log("Registering:", this.formData);
        // Add your registration logic here
      }
    },
  },
};
</script>