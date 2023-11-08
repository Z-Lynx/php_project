<template>
  <div id="app">
    <nav>
      <ul>
        <li><a href="#" style="color: #333; font-size: 40px; font-weight: bold;">DACODE</a></li>
        <li><a href="#">HOME</a></li>
        <li><a href="#">PRODUCT</a></li>
        <li><a href="#">CART</a></li>
        <li><a href="#">BLOG</a></li>
        <li>
          <input type="text" v-model="searchTerm" placeholder="Search..." />
          
        </li>
        <li>
          <sign-in-button @toggle-sign-in="toggleSignIn" />
          <sign-up-button @toggle-sign-up="toggleSignUp" />
        </li>
      </ul>
    </nav>
      <ul>
        <li><a href="#">HOME</a></li>
      </ul>
  </div>
</template>

<script>
import SignInButton from './components/SignInButton.vue';
import SignUpButton from './components/SignUpButton.vue';

export default {
  data() {
    return {
      searchTerm: '',
      isSignIn: true,
      isSignUp: false
    };
  },
  components: {
    SignInButton,
    SignUpButton
  },
  methods: {
    toggleSignIn() {
      this.isSignIn = !this.isSignIn;
      this.isSignUp = false;
    },
    toggleSignUp() {
      this.isSignUp = !this.isSignUp;
      this.isSignIn = false;
    }
  }
};
</script>

<style>
  nav ul {
    list-style-type: none;
    display: flex;
    justify-content: space-between; 
    align-items: center;
  }

  nav ul li {
    display: inline-block;
    margin-right: 10px;
  }

  a {
    color: #000000; /* Màu chữ */
    text-decoration: none;
    font-size: 16px; /* Cỡ chữ */
  }

  input[type="text"] {
    padding: 5px;
    font-size: 14px;
    width: 450px;
    border-radius: 15px;
  }

</style>

