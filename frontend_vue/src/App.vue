<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import Toast from "primevue/toast";

const firebaseConfig = {
  apiKey: "AIzaSyAd0F-UNRaEoy9mwqV_yLOB5ik6IGGhUsw",
  authDomain: "phpproject-67af3.firebaseapp.com",
  projectId: "phpproject-67af3",
  storageBucket: "phpproject-67af3.appspot.com",
  messagingSenderId: "554630472725",
  appId: "1:554630472725:web:f13d36821d3c776ae29a1c",
  measurementId: "G-BVRME0HBKJ",
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

</script>

<template>
  <Toast />
  <Header />
  <RouterView />
  <div class="pt-10">
    <Footer />
  </div>
</template>
