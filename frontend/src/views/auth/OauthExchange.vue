<script setup>
import { apiOAuthExchangeToken } from '@/functions/api/auth';
import { useUserStore } from '@/stores/user';
import { onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
const route = useRoute();
const router = useRouter();
const userStore = useUserStore();
onMounted(async () => {
    const token = route.query.token
    const res = await apiOAuthExchangeToken(token);

    if (route.query.error) return alert(route.query.error);

    userStore.setSanctumToken(res.data.token);
    userStore.setUserState(res.data.user);

    alert('Login success');
    router.replace({ name: 'chats' });
})
</script>
<template>
</template>