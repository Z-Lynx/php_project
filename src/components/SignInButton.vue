<template>
    <button @click="toggleSignIn">SIGN IN</button>
  </template>
  
  <script>
  export default {
    methods: {
      toggleSignIn() {
        this.$emit('toggle-sign-in');
      }
    }
  };
  </script>
  
  <style src="../styles/custom-styles.css"></style>
  