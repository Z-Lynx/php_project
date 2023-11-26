import AxiosCustom from "../instance/http-common";

class ClientService {
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
