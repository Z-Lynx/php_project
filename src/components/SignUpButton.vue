<template>
    <button @click="toggleSignUp">SIGN UP</button>
  </template>
  
  <script>
  export default {
    methods: {
      toggleSignUp() {
        this.$emit('toggle-sign-up');
      }
    }
  };
  </script>
  
  <style src="../styles/custom-styles.css"></style>
  