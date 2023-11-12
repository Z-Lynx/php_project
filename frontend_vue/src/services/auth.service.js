import store from "../store";
import AxiosCustom from "../instance/http-common";
import Cookies from "js-cookie";

class AuthService {
  login(user) {
    return AxiosCustom.post("/login", {
      email: user.username,
      password: user.password,
    }).then((response) => {
      console.log(response.data.data.user);
      console.log(response.data.data.token);
      localStorage.setItem("user", JSON.stringify(response.data.data.user));
      Cookies.set("token", response.data.data.token, { expires: 10080, path: "/", httpOnly: true });

      // if (response.data.accessToken) {
      //     store.dispatch({
      //         type: 'LOGIN_SUCCESS',
      //         payload: { user: response.data }
      //     });
      // }

      return response.data;
    });
  }

  register(user) {
    return axios
      .post(API_URL + "signup", {
        username: user.username,
        email: user.email,
        password: user.password,
      })
      .then((response) => {
        if (response.data.accessToken) {
          store.dispatch({
            type: "REGISTER_SUCCESS",
            payload: { user: response.data },
          });
        }

        return response.data;
      });
  }
}

export default new AuthService();
