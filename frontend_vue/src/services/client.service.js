import AxiosCustom from "../instance/http-common";

class ClientService {
  updateProfile(payload) {
    if (payload.hasOwnProperty("image")) {
      const formData = new FormData();
      formData.append("image", payload.image);

      return AxiosCustom.post("/update-profile", formData).then((response) => {
        return response.data;
      });
    }
    return AxiosCustom.post("/update-profile", payload).then((response) => {
      return response.data;
    });
  }

  getMyOrder() {
    return AxiosCustom.get("/my-order").then((response) => {
      return response.data;
    });
  }
  getProducts(page = 1) {
    return AxiosCustom.get("/get-products?page=" + page).then((response) => {
      return response.data;
    });
  }
  getProductDetail(id) {
    return AxiosCustom.get("/get-product/" + id).then((response) => {
      return response.data;
    });
  }

  getCarts() {
    return AxiosCustom.get("/get-carts").then((response) => {
      return response.data;
    });
  }
  addToCart(product) {
    return AxiosCustom.post("/add-to-cart", {
      product_id: product.product_id,
      quantity: product.quantity,
    }).then((response) => {
      return response.data;
    });
  }
  updateCart(product) {
    return AxiosCustom.put(`/update-cart/${product.id}`, {
      user_id: product.user_id,
      product_id: product.product.id,
      quantity: product.quantity,
    }).then((response) => {
      return response.data;
    });
  }

  removeCart(id) {
    return AxiosCustom.delete(`/remove-cart/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new ClientService();
