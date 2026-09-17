```vue
<script setup>
import { apiRegister } from '@/functions/api/auth';
import { useUserStore } from '@/stores/user';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const userStore = useUserStore();

const user = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const userError = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const defaultUser = {
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
};

const defaultUserError = {
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
};

const resetUserState = () => {
    user.value = { ...defaultUser };
    userError.value = { ...defaultUserError };
};

async function register() {
    try {
        const res = await apiRegister(user.value);

        console.log(res.data);

        // If your API returns token + user
        userStore.setSanctumToken(res.data.token);
        userStore.setUserState(res.data.user);

        // Go to chats after register
        router.replace({ name: 'chats' });

    } catch (error) {
        console.log(error);

        if (error.response?.data?.errors) {
            userError.value = error.response.data.errors;
        } else {
            alert(error.response?.data?.message || error.message);
        }
    }
}
</script>

<template>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-800 text-center">
                Create Account
            </h2>

            <p class="text-gray-500 text-center mt-2">
                Register your account
            </p>

            <!-- Form -->
            <form class="mt-6 space-y-4" @submit.prevent="register">

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 mb-1">
                        Name
                    </label>

                    <input v-model="user.name" type="text" placeholder="Enter your name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />

                    <p v-if="userError.name" class="text-red-500 text-sm mt-1">
                        {{ userError.name[0] }}
                    </p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 mb-1">
                        Email
                    </label>

                    <input v-model="user.email" type="email" placeholder="Enter your email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />

                    <p v-if="userError.email" class="text-red-500 text-sm mt-1">
                        {{ userError.email[0] }}
                    </p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 mb-1">
                        Password
                    </label>

                    <input v-model="user.password" type="password" placeholder="Enter your password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />

                    <p v-if="userError.password" class="text-red-500 text-sm mt-1">
                        {{ userError.password[0] }}
                    </p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-gray-700 mb-1">
                        Confirm Password
                    </label>

                    <input v-model="user.password_confirmation" type="password" placeholder="Confirm your password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" />

                    <p v-if="userError.password_confirmation" class="text-red-500 text-sm mt-1">
                        {{ userError.password_confirmation[0] }}
                    </p>
                </div>

                <!-- Register Button -->
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Register
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-3 my-4">
                    <hr class="flex-1 border-gray-300" />

                    <span class="text-gray-400 text-sm">
                        OR
                    </span>

                    <hr class="flex-1 border-gray-300" />
                </div>

                <!-- Google Register -->
                <button type="button"
                    class="w-full flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google Logo" />

                    <span class="text-gray-700 font-medium">
                        Register with Google
                    </span>
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center text-gray-600 text-sm mt-6">
                Already have an account?

                <a href="/login" class="text-green-600 font-semibold hover:underline">
                    Login
                </a>
            </p>
        </div>
    </div>
</template>
```
