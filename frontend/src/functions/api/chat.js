import api from "@/services/api";

export async function apiGetChatMessages(receiverId) {
    return await api.get('/getChatMessages/' + receiverId)
}

export async function apiSendChatMessage(message) {
    return await api.post('/sendChatMessage', message)
}