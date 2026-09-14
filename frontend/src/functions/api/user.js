import api from "@/services/api";

export async function apiGetUsers() {
    return await api.get('/users')
}