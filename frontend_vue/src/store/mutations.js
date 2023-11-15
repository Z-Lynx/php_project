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
  state.user.data = null;
  state.user.token = null;
}

export function changeStatusActivate(state) {
  state.user.data.is_active = true;
}
