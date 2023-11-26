import AxiosCustom from "../instance/http-common";

class ImageProductsService {
  getImageProducts() {
    return AxiosCustom.get("/image-products").then((response) => {
      return response.data;
    });
  }

  getImageProduct(id) {
    return AxiosCustom.get(`/image-products/${id}`).then((response) => {
      return response.data;
    });
  }

  createImageProduct(imageProduct) {
    const formData = new FormData();
    formData.append("product_id", imageProduct.product_id);

    if (imageProduct.image instanceof File) {
      formData.append("image", imageProduct.image);
    }
    

    return AxiosCustom.post("/image-products", formData).then((response) => {
      return response.data;
    });
  }

  updateImageProduct(imageProduct) {
    const formData = new FormData();
    formData.append("product_id", imageProduct.product_id);
    
    if (imageProduct.image instanceof File) {
      formData.append("image", imageProduct.image);
    }

    return AxiosCustom.post(`/image-products/${imageProduct.id}?_method=PUT`, formData).then((response) => {
      return response.data;
    });
  }

  deleteImageProduct(id) {
    return AxiosCustom.delete(`/image-products/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new ImageProductsService();