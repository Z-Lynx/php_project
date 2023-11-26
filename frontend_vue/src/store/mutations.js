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

export function setToken(state, token) {
  state.user.data.fcm_id = token;

  // over write user
  const user = JSON.parse(localStorage.getItem("user"));
  user.fcm_id = token;
  localStorage.setItem("user", JSON.stringify(user));
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
  state.user.countNotifications = notifications.filter((item) => item.read_at === false).length;

  state.user.notifications.sort((a, b) => {
    var keyA = new Date(a.created_at),
      keyB = new Date(b.created_at);
    if (keyA > keyB) return -1;
    if (keyA < keyB) return 1;
    return 0;
  });
}

export function updateNotifications(state, notifications) {
  state.user.notifications = [...state.user.notifications, notifications];
  state.user.countNotifications += 1;
  state.user.notifications.sort((a, b) => {
    var keyA = new Date(a.created_at),
      keyB = new Date(b.created_at);
    // Compare the 2 dates
    if (keyA > keyB) return -1;
    if (keyA < keyB) return 1;
    return 0;
  });
}

export function readNotifications(state, idNotifications) {
  state.user.notifications.map((notification) => {
    if (notification.id === idNotifications) {
      notification.read_at = true;
    }
  });
  state.user.countNotifications -= 1;
}

export function getCart(state, cart) {
  state.cart.data = cart;
  state.cart.count = cart.length;
}

export function addToCart(state, product) {
  state.cart.data.push(product);
  state.cart.count += 1;
}

export function updateCart(state, product) {
  state.cart.data.map((item) => {
    if (item.id === product.id) {
      item.quantity = product.quantity;
    }
  });
}

export function removeCart(state, cart) {
  state.cart.data = state.cart.data.filter((item) => item.id !== cart.id);
  state.cart.count -= 1;
}