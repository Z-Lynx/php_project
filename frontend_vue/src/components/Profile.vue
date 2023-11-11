<template>
  <div>
    <div v-if="user">
      <img :src="user.avatar" alt="User Avatar" />
      <h2>{{ user.name }}</h2>
      <p>{{ user.email }}</p>
    </div>
    <div class="flex items-center space-x-3" v-else>
      <router-link to="/login">
        <button class="hidden md:block bg-black text-white px-3 py-1">SIGN IN</button>
      </router-link>
      <router-link to="/register">
        <button class="hidden lg:block bg-white text-black px-3 py-1 border border-black" @click="login">SIGN UP</button>
      </router-link>
    </div>
  </div>
</template>

<script></script>
