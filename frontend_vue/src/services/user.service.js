import AxiosCustom from "../instance/http-common";

class UsersService {
  getUsers(page = 1) {
    return AxiosCustom.get("/users?page=" + page).then((response) => {
      return response.data;
    });
  }

  getUser(id) {
    return AxiosCustom.get(`/users/${id}`).then((response) => {
      return response.data;
    });
  }

  createUser(user) {
    return AxiosCustom.post("/users", {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation,
    }).then((response) => {
      return response.data;
    });
  }

  updateUser(user) {
    return AxiosCustom.put(`/users/${user.id}`, {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation,
    }).then((response) => {
      return response.data;
    });
  }

  deleteUser(id) {
    return AxiosCustom.delete(`/users/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new UsersService();
