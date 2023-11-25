import AxiosCustom from "../instance/http-common";

class CartsServices {
  getCart() {
    return AxiosCustom.get("/carts").then((response) => {
      return response.data;
    });
  }

  addToCart(product) {
    return AxiosCustom.post("/carts", {
      product_id: product.id,
      quantity: product.quantity,
    }).then((response) => {
      return response.data;
    });
  }

  updateCart(product) {
    return AxiosCustom.put(`/carts/${product.id}`, {
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
