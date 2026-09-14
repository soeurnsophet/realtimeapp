<script setup>
import { apiLogin } from '@/functions/api/auth';
import { useUserStore } from '@/stores/user';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter()
const user = ref({
    email: '',
    password: ''
})
const userError = ref({
    email: '',
    password: ''
})

const defualtUser = {
    email: '',
    password: ''
}
const defualtUserError = {
    email: '',
    password: ''
}

const resetUserState = () => {
    user.value = defualtUser
    userError.value = defualtUserError
}

const userStore = useUserStore()
async function login() {
    try {
        const res = await apiLogin(user.value)
        console.log(res.data.token);

        userStore.setSanctumToken(res.data.token)
        userStore.setUserState(res.data.user)

        router.replace({ name: 'chats' })
    } catch (error) {
        alert(error.message)
        resetUserState()
    }
}

</script>
<template>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-800 text-center">Welcome Back</h2>
            <p class="text-gray-500 text-center mt-2">Login to your account</p>

            <!-- Form -->
            <form class="mt-6 space-y-4" @submit.prevent="login">
                <!-- Email -->
                <div>
                    <label class="block text-gray-700 mb-1">Email</label>
                    <input v-model="user.email" type="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 mb-1">Password</label>
                    <input v-model="user.password" type="password" placeholder="Enter your password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Login
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-3 my-4">
                    <hr class="flex-1 border-gray-300" />
                    <span class="text-gray-400 text-sm">OR</span>
                    <hr class="flex-1 border-gray-300" />
                </div>

                <!-- Google Login -->
                <button type="button"
                    class="w-full flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google Logo" />

                    <span class="text-gray-700 font-medium">Login with Google</span>
                </button>
            </form>

            <!-- Register Link -->
            <p class="text-center text-gray-600 text-sm mt-6">
                Don't have an account?
                <a href="/" class="text-green-600 font-semibold hover:underline">
                    Register
                </a>
            </p>
        </div>
    </div>
</template>
