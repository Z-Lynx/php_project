import store from "../store";
import AxiosCustom from "../instance/http-common";
import Cookies from "js-cookie";

class AuthService {
  activateUser(token) {
    return AxiosCustom.get("/email/verify/" + token).then((response) => {
      store.dispatch("changeStatusActivate");
      return response.data;
    });
  }
  resendActivateUser() {
    return AxiosCustom.post("/email/resend").then((response) => {
      return response.data;
    });
  }

  getUser() {
    return AxiosCustom.get("/info").then((response) => {
      return response.data;
    });
  }

  logout() {
    return AxiosCustom.post("/logout").then((response) => {
      localStorage.clear();
      Cookies.remove("token");
      store.dispatch("removeUser");
      return response.data;
    });
  }

  login(user) {
    return AxiosCustom.post("/login", {
      email: user.username,
      password: user.password,
    }).then((response) => {
      store.dispatch("setUser", response.data.data);
      store.dispatch("getNotifications");
      store.dispatch("getCart");
      return response.data;
    });
  }

  register(user) {
    return AxiosCustom.post("register", {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation,
    }).then((response) => {
      store.dispatch("setUser", response.data.data);

      return response.data;
    });
  }

  forgotPassword(email) {
    return AxiosCustom.post("forgot-password", {
      email: email,
    }).then((response) => {
      return response.data;
    });
  }

  resetPassword(payload) {
    return AxiosCustom.post("reset-password", payload).then((response) => {
      return response.data;
    });
  }

  setToken(payload) {
    return AxiosCustom.post("set-token", {
      fcm_id: payload,
    }).then((response) => {
      return response.data;
    });
  }

  getNotifications() {
    return AxiosCustom.get("notifications").then((response) => {
      return response.data;
    });
  }

  readNotifications(payload) {
    return AxiosCustom.post("notifications",{
      id: payload,
    });
  }
}

export default new AuthService();
