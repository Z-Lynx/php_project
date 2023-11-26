import Cookies from "js-cookie";

export default {
  user: {
    token: Cookies.get("token") || null,
    data: JSON.parse(localStorage.getItem("user")) || null,
    notifications: [],
    countNotifications: 0,
  },
  cart: {
    data: [],
    count: 0,
  },
};
