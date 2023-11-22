import axios from "axios";
import Cookies from "js-cookie";
import state from "../store/state";
// Create an Axios instance
const AxiosCustom = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
});

// Add a request interceptor
AxiosCustom.interceptors.request.use(
  (config) => {
    console.log("interceptor");
    const token = Cookies.get("token");
    
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default AxiosCustom;
