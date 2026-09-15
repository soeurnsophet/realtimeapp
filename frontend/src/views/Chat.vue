<script setup>
import ChatList from "@/components/Chats/ChatList.vue";
import { apiGetChatMessages, apiSendChatMessage } from "@/functions/api/chat";
import { apiGetUsers } from "@/functions/api/user";
import { useUserStore } from "@/stores/user";
import { nextTick, onMounted, ref } from "vue";
const chatList = ref([]);
const selectedChat = ref({});
const chatMessages = ref([]);
async function apiGetChatList() {
    const res = await apiGetUsers();
    chatList.value = res.data.users;
}
onMounted(async () => {
    await apiGetChatList();
});
const handleSelectChat = (user) => {
    selectedChat.value = user;
    getChatMessage(user.id);
};
async function getChatMessage(id) {
    const res = await apiGetChatMessages(id);
    chatMessages.value = res.data.messages;
}

const authUser = useUserStore();
const message = ref("");
async function sendMessage() {
    const messagePayload = {
        sender_id: authUser.id,
        receiver_id: selectedChat.value.id,
        message: message.value,
    };
    const res = await apiSendChatMessage(messagePayload);
    chatMessages.value.push(res.data.message);
    message.value = "";
    await nextTick();
    scrollToBottom();
}

const chatWindow = ref(null);

function scrollToBottom() {
    if (!chatWindow.value) return;

    chatWindow.value.scrollTop = chatWindow.value.scrollHeight;
}
</script>

<template>
    <div class="mx-auto p-4 bg-gray-100 min-h-screen">
        <div class="flex flex-col md:flex-row">
            <!-- Left sidebar - Chat list -->
            <ChatList :chatList="chatList" @selectChat="handleSelectChat" />
            <!-- Right side - Chat window -->
            <div class="w-full bg-white rounded-tr-lg rounded-br-lg shadow flex flex-col"
                style="height: calc(100vh - 42px)">
                <!-- Chat header -->
                <div class="p-4 border-b border-gray-200 flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile"
                        class="w-10 h-10 rounded-full object-cover" />
                    <div class="ml-3">
                        <h3 class="font-medium">{{ selectedChat.name }}</h3>
                        <p class="text-xs text-gray-500">Active now</p>
                    </div>
                    <div class="ml-auto flex space-x-3">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-video"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>
                <!-- Messages area -->
                <div ref="chatWindow" id="chat-window" class="flex-1 p-4 overflow-y-auto bg-gray-50 sr">
                    <div v-for="(message, index) in chatMessages" :key="index" class="flex mb-4" :class="message.sender_id === authUser.id
                        ? 'justify-end'
                        : 'justify-start'
                        ">
                        <!-- Incoming -->
                        <template v-if="message.sender_id !== authUser.id">
                            <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Profile"
                                class="w-8 h-8 rounded-full object-cover mt-1" />

                            <div class="ml-3">
                                <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs">
                                    <p>{{ message.message }}</p>
                                </div>

                                <span class="text-xs text-gray-500 mt-1 block">
                                    {{ message.created_at }}
                                </span>
                            </div>
                        </template>

                        <!-- Outgoing -->
                        <template v-else>
                            <div class="mr-3 text-right">
                                <div class="bg-blue-500 text-white p-3 rounded-lg rounded-tr-none shadow-sm max-w-xs">
                                    <p>{{ message.message }}</p>
                                </div>

                                <span class="text-xs text-gray-500 mt-1 block">
                                    {{ message.created_at }}
                                    <i class="fas fa-check ml-1 text-blue-500"></i>
                                </span>
                            </div>

                            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile"
                                class="w-8 h-8 rounded-full object-cover mt-1" />
                        </template>
                    </div>
                </div>
                <!-- Message input -->
                <div class="p-3 border-t">
                    <div class="flex items-center">
                        <button class="text-gray-500 mx-2">
                            <i class="far fa-smile"></i>
                        </button>
                        <button class="text-gray-500 mx-2">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <button class="text-gray-500 mx-2">
                            <i class="fas fa-camera"></i>
                        </button>
                        <input v-model="message" type="text" placeholder="Message..."
                            class="flex-1 bg-gray-100 rounded-full py-2 px-4 focus:outline-none" />
                        <button @click="sendMessage" :disabled="!message"
                            class="ml-2 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center"
                            :class="!message ? 'opacity-50 cursor-not-allowed' : ''">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.sr {
    --sb-track-color: #fafafa;
    --sb-thumb-color: #545454;
    --sb-size: 6px;
}

.sr::-webkit-scrollbar {
    height: 6px;
    width: var(--sb-size);
}

.sr::-webkit-scrollbar-track {
    background: var(--sb-track-color);
    border-radius: 3px;
}

.sr::-webkit-scrollbar-thumb {
    background: var(--sb-thumb-color);
    border-radius: 3px;
}

@supports not selector(::-webkit-scrollbar) {
    .sr {
        scrollbar-color: var(--sb-thumb-color) var(--sb-track-color);
    }
}
</style>
