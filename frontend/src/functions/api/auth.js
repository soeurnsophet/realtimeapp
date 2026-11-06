import api from "@/services/api";

export async function apiLogin(user) {
    return await api.post('/login', user)
}

export async function apiVerify() {
    return await api.get('/verify')
}

export async function apiRegister(user) {
    return await api.post('/register', { ...user, callback_url: import.meta.env.VITE_API_URL_EMAIL_VERIFY_CALLBACK },)
}

export async function apiOAuthExchangeToken(token) {
    return await api.post('/oauth/exhange-token', {}, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    })
}

export async function apiResendEmailVerification(email) {
    return await api.post('/resend-email-verification', { email: email, callback_url: import.meta.env.VITE_API_URL_EMAIL_VERIFY_CALLBACK })
}