importScripts("https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js");

firebase.initializeApp({
  apiKey: "AIzaSyAd0F-UNRaEoy9mwqV_yLOB5ik6IGGhUsw",
  authDomain: "phpproject-67af3.firebaseapp.com",
  projectId: "phpproject-67af3",
  storageBucket: "phpproject-67af3.appspot.com",
  messagingSenderId: "554630472725",
  appId: "1:554630472725:web:f13d36821d3c776ae29a1c",
  measurementId: "G-BVRME0HBKJ",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log("[firebase-messaging-sw.js] Received background message ", payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: "../src/assets/logo.png",
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
