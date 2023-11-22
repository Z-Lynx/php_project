import authService from "../services/auth.service";

export async function getUser({ commit })  {
  try{
   const resData = await authService.getUser();
   commit("getUser", resData.data);
  }catch(e){
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
