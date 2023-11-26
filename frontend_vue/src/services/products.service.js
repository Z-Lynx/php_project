import AxiosCustom from "../instance/http-common";

class ProductsServices {
  getProducts() {
    return AxiosCustom.get("/products").then((response) => {
      return response.data;
    });
  }

  getProduct(id) {
    return AxiosCustom.get(`/products/${id}`).then((response) => {
      return response.data;
    });
  }

  createProduct(product) {
    const formData = new FormData();
    formData.append("name", product.name);
    formData.append("price", product.price);
    formData.append("sale_price", product.sale_price);
    formData.append("description", product.description);
    formData.append("category_id", product.category_id);
    formData.append("image", product.image);
    formData.append("slug", product.slug);

    return AxiosCustom.post("/products", formData).then((response) => {
      return response.data;
    });
  }

  updateProduct(product) {
    const formData = new FormData();
    formData.append("name", product.name);
    formData.append("price", product.price);
    formData.append("sale_price", product.sale_price);
    formData.append("description", product.description);
    formData.append("category_id", product.category_id);

    if (product.image instanceof File) {
      formData.append("image", product.image);
    }
    
    formData.append("slug", product.slug);

    return AxiosCustom.post(`/products/${product.id}?_method=PUT`, formData).then((response) => {
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
