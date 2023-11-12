class ApiModel {
  constructor() {
    this.data = null;
    this.message = null;
    this.statusCode = null;
    this.success = null;
  }
}

export const formatApiResponse = (response) => {
  const apiModel = new ApiModel();

  if (response && response.data) {
    apiModel.data = response.data.data;
    apiModel.message = response.data.message;
    apiModel.statusCode = response.status;
    apiModel.success = response.status >= 200 && response.status < 300;
  }

  return apiModel;
};
