// Service for retrieving and posting via axios

import axios from "axios";

const baseUrl =
  "https://stevethedeveloper.com/projects/custom_ink/backend/index.php/url";

const add = (newObject) => {
  const request = axios({
    method: "post",
    url: `${baseUrl}/add`,
    data: newObject,
    headers: { "Content-Type": "multipart/form-data" },
  });
  return request.then((response) => response.data);
};

const get = (shortCode, newObject) => {
  const request = axios.get(`${baseUrl}/get/${shortCode}`);
  return request.then((response) => response.data);
};

const exportObject = {
  add,
  get,
};

export default exportObject;
