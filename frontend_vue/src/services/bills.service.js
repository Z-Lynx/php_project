import AxiosCustom from "../instance/http-common";

class BillsServices {
  getBills() {
    return AxiosCustom.get("/bills").then((response) => {
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
      user_id: bill.user_id,
      product_id: bill.product_id,
      quantity: bill.quantity,
      total_amount: bill.total_amount,
      status: bill.status,
    }).then((response) => {
      return response.data;
    });
  }

  updateBill(bill) {
    return AxiosCustom.put(`/bills/${bill.id}`, {
      user_id: bill.user_id,
      product_id: bill.product_id,
      quantity: bill.quantity,
      total_amount: bill.total_amount,
      status: bill.status,
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