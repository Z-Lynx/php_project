import AxiosCustom from "../instance/http-common";

class CategoriesService {
  getCategories() {
    return AxiosCustom.get("/categories").then((response) => {
      return response.data;
    });
  }

  getCategory(id) {
    return AxiosCustom.get(`/categories/${id}`).then((response) => {
      return response.data;
    });
  }

  createCategory(category) {
    return AxiosCustom.post("/categories", {
      name: category.name,
      slug: category.slug,
    }).then((response) => {
      return response.data;
    });
  }

  updateCategory(category) {
    return AxiosCustom.put(`/categories/${category.id}`, {
      name: category.name,
      slug: category.slug,
    }).then((response) => {
      return response.data;
    });
  }

  deleteCategory(id) {
    return AxiosCustom.delete(`/categories/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new CategoriesService();
