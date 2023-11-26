import AxiosCustom from "../instance/http-common";

class ClientService {
    getProducts() {
        return AxiosCustom.get("/get-products").then((response) => {
            return response.data;
        });
    }
}

export default new ClientService();