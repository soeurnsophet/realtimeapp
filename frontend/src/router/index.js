import Login from '@/views/auth/Login.vue'
import Chat from '@/views/Chat.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'auth.login',
            component: Login
        },
        {
            path: '/chats',
            name: 'chats',
            component: Chat
        }
    ]
})

export default router