import authService from "../services/auth.service";
import clientService from "../services/client.service";

export async function getUser({ commit }) {
  try {
    const resData = await authService.getUser();
    commit("getUser", resData.data);
  } catch (e) {
    commit("removeUser");
  }
}

export async function updateProfile({ commit }, payload) {
  commit("updateProfile", payload);
}

export async function setToken({ commit }, payload) {
  try {
    const resData = await authService.setToken(payload);
    commit("setToken", payload);
  } catch (e) {
    commit("removeUser");
  }
}

export async function getNotifications({ commit }) {
  try {
    const resData = await authService.getNotifications();
    commit("getNotifications", resData.data);
  } catch (e) {
    commit("removeUser");
  }
}

export function setUser({ commit }, payload) {
  commit("setUser", payload);
}

export function removeUser({ commit }) {
  commit("removeUser");
}

export function changeStatusActivate({ commit }) {
  commit("changeStatusActivate");
}

export function updateNotifications({ commit }, payload) {
  commit("updateNotifications", payload);
}

export function readNotifications({ commit }, payload) {
  commit("readNotifications", payload);
}

export async function getCart({ commit }) {
  try {
    const resData = await clientService.getCarts();
    commit("getCart", resData.data);
  } catch (e) {
    commit("removeUser");
  }
}

export async function addToCart({ commit }, payload) {
  commit("addToCart", payload);
}

export async function updateCart({ commit }, payload) {
  commit("updateCart", payload);
}

export async function removeCart({ commit }, payload) {
  commit("removeCart", payload);
}

export async function removeAllCart({ commit }) {
  commit("removeAllCart");
}
