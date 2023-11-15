import authService from "../services/auth.service";

export function getUser({ commit }) {
  authService.getUser().then((response) => {
    commit("getUser", response.data);
  });
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
