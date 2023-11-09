<template>
  <div class="login-container">
    <div class="input-container">
      <label for="username">Username</label>
      <input type="text" class="rounded-input" placeholder="Username" />
    </div>
    <div class="input-container">
      <label for="password">Password</label>
      <input type="password" class="rounded-input" placeholder="Password" />
    </div>
    <div class="input-container">
      <label for="phone">Phone number</label>
      <input type="text" class="rounded-input" placeholder="Phone number" />
    </div>
    <button class="login-button rounded-button">LOGIN</button>
    <div class="separator"></div>
    <div class="button-container">
      <button class="facebook-button rounded-button">Continue with your Facebook account</button>
      <button class="google-button rounded-button">Continue with your Google account</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
.login-container {
  text-align: center;
  margin: 50px auto;
  max-width: 740px; 
}

.input-container {
  margin: 10px 0;
  display: flex;
  align-items: center;
  justify-content: center; 
}

label {
  display: block;
  font-weight: bold;
}

.rounded-input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 20px;
}

.login-button,
facebook-button,
google-button {
  width: 100%;
  padding: 10px 0;
  cursor: pointer;
  font-weight: bold;
  text-transform: uppercase;
  border-radius: 20px;
}

.login-button {
  width: 192px; 
  height: 34px; 
  background-color: #000;
  color: #fff;
  border: none;
}

facebook-button,
google-button {
  height: 42px; 
  background-color: #1877f2; 
  color: #fff;
  border: none;
  margin-top: 10px;
  cursor: pointer;
  border-radius: 20px;
}

google-button {
  background-color: #4285f4; 
}

.separator {
  margin: 20px 0;
  border-radius: 20px;
}

.button-container {
  display: flex;
  flex-direction: column;
  align-items: center; 
}
</style>
