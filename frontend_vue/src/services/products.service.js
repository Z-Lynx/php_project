import AxiosCustom from "../instance/http-common";

class ProductsServices {
  getProducts(page = 1) {
    return AxiosCustom.get("/products?page=" + page).then((response) => {
      return response.data;
    });
  }

  getProduct(id) {
    return AxiosCustom.get(`/products/${id}`).then((response) => {
      return response.data;
    });
  }

  createProduct(product) {
    return AxiosCustom.post("/products", {
      name: product.name,
      price: product.price,
      description: product.description,
      category_id: product.category_id,
    }).then((response) => {
      return response.data;
    });
  }

  updateProduct(product) {
    return AxiosCustom.put(`/products/${product.id}`, {
      name: product.name,
      price: product.price,
      description: product.description,
      category_id: product.category_id,
    }).then((response) => {
      return response.data;
    });
  }

  deleteProduct(id) {
    return AxiosCustom.delete(`/products/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new ProductsServices();
