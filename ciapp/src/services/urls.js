import axios from "axios";
const baseUrl =
  "https://stevethedeveloper.com/projects/custom_ink/backend/index.php/url";

const getAll = () => {
  const request = axios.get(`${baseUrl}/get/all`);
  return request.then((response) => response.data);
};

const add = (newObject) => {
  const request = axios({
    method: "post",
    url: "https://stevethedeveloper.com/projects/custom_ink/backend/index.php/url/add",
    data: newObject,
    headers: { "Content-Type": "multipart/form-data" },
  });
  return request.then((response) => response.data);
};

const get = (shortCode, newObject) => {
  const request = axios.get(`${baseUrl}/get/${shortCode}`);
  return request.then((response) => response.data);
};

export default { getAll, add, get };
