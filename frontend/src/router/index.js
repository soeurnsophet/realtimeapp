import { apiVerify } from '@/functions/api/auth'
import { useUserStore } from '@/stores/user'
import Login from '@/views/auth/Login.vue'
import OauthExchange from '@/views/auth/OauthExchange.vue'
import Register from '@/views/auth/Register.vue'
import Chat from '@/views/Chat.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'auth.login',
            component: Login,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/register',
            name: 'auth.register',
            component: Register,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/oauth/callback',
            name: 'auth.exchange-token',
            component: OauthExchange,
            meta: {
                requiresAuth: false
            }
        },
        {
            path: '/chats',
            name: 'chats',
            component: Chat,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/:pathMatch(.*)*',
            redirect: { name: 'auth.login' }
        }
    ]
})

router.beforeEach(async to => {
    const { requiresAuth } = to.meta
    const userStore = useUserStore()
    const token = userStore.getSanctumToken()

    if (requiresAuth && !token) {
        return { name: 'auth.login' }
    }

    if (requiresAuth && token) {
        try {
            const res = await apiVerify()
            userStore.setUserState(res.data.user)
        } catch (error) {
            userStore.resetState()
            return { name: 'auth.login' }
        }
    }

    if (!requiresAuth && token) {
        return { name: 'chats' }
    }
})

export default router
