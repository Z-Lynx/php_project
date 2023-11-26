import AxiosCustom from "../instance/http-common";

class CartsServices {
  getCart() {
    return AxiosCustom.get("/carts").then((response) => {
      return response.data;
    });
  }

  addToCart(product) {
    return AxiosCustom.post("/carts", {
      user_id: product.user_id,
      product_id: product.product_id,
      quantity: product.quantity,
    }).then((response) => {
      return response.data;
    });
  }

  updateCart(product) {
    return AxiosCustom.put(`/carts/${product.id}`, {
      user_id: product.user_id,
      product_id: product.product_id,
      quantity: product.quantity,
    }).then((response) => {
      return response.data;
    });
  }

  deleteCart(id) {
    return AxiosCustom.delete(`/carts/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new CartsServices();
