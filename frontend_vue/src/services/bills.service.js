import AxiosCustom from "../instance/http-common";

class BillsServices {
  getBills(page = 1) {
    return AxiosCustom.get("/bills?page=" + page).then((response) => {
      return response.data;
    });
  }

  getBill(id) {
    return AxiosCustom.get(`/bills/${id}`).then((response) => {
      return response.data;
    });
  }

  createBill(bill) {
    return AxiosCustom.post("/bills", {
      name: bill.name,
      price: bill.price,
      description: bill.description,
      category_id: bill.category_id,
    }).then((response) => {
      return response.data;
    });
  }

  updateBill(bill) {
    return AxiosCustom.put(`/bills/${bill.id}`, {
      name: bill.name,
      price: bill.price,
      description: bill.description,
      category_id: bill.category_id,
    }).then((response) => {
      return response.data;
    });
  }

  deleteBill(id) {
    return AxiosCustom.delete(`/bills/${id}`).then((response) => {
      return response.data;
    });
  }
}

export default new BillsServices();