import api from "@/services/api";

export async function apiLogin(user) {
    return await api.post('/login', user)
}

export async function apiVerify() {
    return await api.get('/verify')
}

export async function apiRegister(user) {
    return await api.post('/register', user)
}

export async function apiOAuthExchangeToken(token) {
    return await api.post('/oauth/exhange-token', {}, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
}
