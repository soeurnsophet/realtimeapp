<script setup>
import api from '@/services/api';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter()
const isEmailVerify = ref(false);
const message = ref('');
onMounted(async () => {
    const frontendUrl = new URLSearchParams(location.search)
        .get('frontend_url')

    try {
        const res = await api.get(frontendUrl)

        message.value = res.data.message
    } catch (error) {
        console.log(error.response?.data)
        message.value = error.response?.data?.message || error.message || "Something went wrong"
    }
})
function gotoLogin() {
    router.replace({ name: 'auth.login' })
}
</script>
<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div class="max-w-xl w-full">
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                <!-- Header with Icon -->
                <div class="text-center mb-8">
                    <div class="success-green-bg inline-flex items-center justify-center w-16 h-16 rounded-full mb-4">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>

                    <p class="text-gray-600 bg-amber-400 text-lg">
                        {{ message }}
                    </p>
                </div>


                <button @click="gotoLogin" type="button"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">Go
                    To Login </button>
            </div>
        </div>


    </div>
</template>