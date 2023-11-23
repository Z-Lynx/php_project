import Cookies from "js-cookie";

export function getUser(state, user) {
  localStorage.setItem("user", JSON.stringify(user));
  state.user.data = user;
}

export function setUser(state, payload) {
  localStorage.setItem("user", JSON.stringify(payload.user));
  Cookies.set("token", payload.token, { expires: 10080, path: "/" });
  
  state.user.data = payload.user;
  state.user.token = payload.token;
}

export function removeUser(state) {
  localStorage.removeItem("user");
  Cookies.remove("token");
  state.user.data = null;
  state.user.token = null;
}

export function changeStatusActivate(state) {
  state.user.data.is_active = true;
}

export function getNotifications(state, notifications) {
  state.user.notifications = notifications;
}

export function updateNotifications(state, notifications) {
  state.user.notifications = [...state.user.notifications, notifications]
}