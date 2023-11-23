<script setup>
import { computed, onMounted } from "vue";
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import Toast from "primevue/toast";
import store from "./store";
import Pusher from "pusher-js";

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

const data = store.getters.getUser;
if (data.token) {
  store.dispatch("getUser");
  store.dispatch("getNotifications");
}

onMounted(() => {
  console.log("mounted");
  var pusher = new Pusher("9799d9bf3eb9505ba6a8", {
    cluster: "ap1",
  });

  var channel = pusher.subscribe("tsc-notifications");

  channel.bind("send-notifications", function (data) {
    console.log(data);
    store.dispatch("updateNotifications", data.data);
  });
});
</script>

<template>
  <Toast />
  <RouterView />
</template>
