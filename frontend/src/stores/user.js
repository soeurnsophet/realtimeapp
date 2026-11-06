import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
        id: null,
        name: '',
        email: '',
    }),
    actions: {
        setUserState(user) {
            this.id = user.id
            this.name = user.name
            this.email = user.email
        },
        resetUserState() {
            this.id = null
            this.name = ''
            this.email = ''
        },
        setSanctumToken(token) {
            localStorage.setItem('SANCTUM_TOKEN', token)
        },
        getSanctumToken() {
            const token = localStorage.getItem('SANCTUM_TOKEN')
            return token && token !== 'null' && token !== 'undefined' ? token : null
        },
        removeSanctumToken() {
            localStorage.removeItem('SANCTUM_TOKEN')
        },
        resetState() {
            this.resetUserState()
            this.removeSanctumToken()
        }
    },
    persist: true
})