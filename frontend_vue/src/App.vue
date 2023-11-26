<script setup>
import { computed, onMounted } from "vue";
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

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
const messaging = getMessaging(app);

onMessage(messaging, (payload) => {
  console.log("Message received. ", payload);
});

Notification.requestPermission();
const data = store.getters.getUser;

if (data.token) {
  store.dispatch("getUser");
  store.dispatch("getCart");
  store.dispatch("getNotifications");
}

onMounted(() => {
  //fcm
  getToken(messaging, { vapidKey: "BGOX4JOSweQOG9tEhpF4IOBowWOfkuRRlwsdoda_Oo9Dkd4a_LY-wem1zSK26g0Op6C3bDvRzRwWsCbQHvSlhLY" })
    .then((currentToken) => {
      if (currentToken) {
        const data = store.getters.getUser;
        if (data.data.fcm_id === null || data.data.fcm_id != currentToken) {
          store.dispatch("setToken", currentToken);
          console.log("Token : " + currentToken);
        }
      } else {
        console.log("No registration token available. Request permission to generate one.");
      }
    })
    .catch((err) => {
      console.log("An error occurred while retrieving token. ", err);
    });

  // pusher
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
