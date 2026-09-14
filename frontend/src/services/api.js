import { useUserStore } from "@/stores/user";
import axios from "axios";

const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL || "http://localhost:8000/api",
    timeout: 5000,
    headers: { "X-Custom-Header": "foobar" },
});
// Add a request interceptor
api.interceptors.request.use(
    function (config) {
        const userSteore = useUserStore()
        const token = userSteore.getSanctumToken()
        if (token) {
            config.headers.Authorization = "Bearer " + token;
        }
        return config;
    },
    function (error) {
        // Do something with request error
        return Promise.reject(error);
    }
);

// Add a response interceptor
api.interceptors.response.use(
    function (response) {
        // Any status code that lie within the range of 2xx cause this function to trigger
        // Do something with response data
        return response;
    },
    function (error) {
        // Any status codes that falls outside the range of 2xx cause this function to trigger
        // Do something with response error
        return Promise.reject(error);
    }
);

export default api

