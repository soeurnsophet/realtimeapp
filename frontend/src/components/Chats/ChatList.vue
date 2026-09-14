<script setup>
const props = defineProps({
    chatList: Array
})
const emit = defineEmits(['selectChat'])

const selectUser = (user) => {
    emit('selectChat', user)
}
</script>
<template>
    <div class="w-full md:w-1/4 bg-white rounded-tl-lg rounded-bl-lg shadow">
        <!-- Header -->
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold">Messages</h2>
            <button class="text-blue-500">
                <i class="fas fa-edit"></i>
            </button>
        </div>
        <!-- Search -->
        <div class="p-3 border-b border-gray-200">
            <div class="relative">
                <input type="text" placeholder="Search"
                    class="w-full bg-gray-100 rounded-full py-2 px-4 pl-10 focus:outline-none">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Chat list -->
        <div class="overflow-y-auto sr" style="height:  calc(100vh - 242px);">
            <!-- Instagram Chat Item -->
            <div v-for="value in chatList" @click="selectUser(value)"
                class="p-3 border-b border-gray-200 flex items-center hover:bg-gray-50 cursor-pointer">
                <div class="hidden sm:block sm:relative">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile"
                        class="w-12 h-12 rounded-full object-cover">
                    <span
                        class="hidden sm:block sm:absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                </div>
                <div class="ml-3 flex-1">
                    <div class="flex justify-between items-center">
                        <h3 class="font-medium">{{ value.name }}</h3>
                        <span class="text-xs text-gray-500">2m ago</span>
                    </div>
                    <p class="text-sm text-gray-500 truncate">Hey! How are you doing?</p>
                </div>
            </div>
            <!-- Twitter Chat Item -->
            <!-- <div class="p-3 border-b border-gray-200 flex items-center hover:bg-gray-50 cursor-pointer">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile"
                        class="w-12 h-12 rounded-full object-cover">
                    <span
                        class="absolute bottom-0 right-0 w-3 h-3 bg-gray-400 rounded-full border-2 border-white"></span>
                </div>
                <div class="ml-3 flex-1">
                    <div class="flex justify-between items-center">
                        <h3 class="font-medium">intrepidusvision</h3>
                        <span class="text-xs text-gray-500">1h ago</span>
                    </div>
                    <p class="text-sm text-gray-500 truncate">Check out this cool article I found!</p>
                </div>
            </div> -->
            <!-- More chat items would go here -->
        </div>
    </div>
</template>