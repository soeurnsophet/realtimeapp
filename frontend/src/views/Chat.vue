<template>
    <div class="mx-auto p-4 bg-gray-100 min-h-screen">
        <div class="flex flex-col md:flex-row">
            <!-- Left sidebar - Chat list -->
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
                <div class="overflow-y-auto" style="height: 500px;">
                    <!-- Instagram Chat Item -->
                    <div class="p-3 border-b border-gray-200 flex items-center hover:bg-gray-50 cursor-pointer">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile"
                                class="w-12 h-12 rounded-full object-cover">
                            <span
                                class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="font-medium">dorcas_</h3>
                                <span class="text-xs text-gray-500">2m ago</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">Hey! How are you doing?</p>
                        </div>
                    </div>
                    <!-- Twitter Chat Item -->
                    <div class="p-3 border-b border-gray-200 flex items-center hover:bg-gray-50 cursor-pointer">
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
                    </div>
                    <!-- More chat items would go here -->
                </div>
            </div>
            <!-- Right side - Chat window -->
            <div class="w-full bg-white rounded-tr-lg rounded-br-lg shadow flex flex-col"
                style="height: calc(100vh - 42px);">
                <!-- Chat header -->
                <div class="p-4 border-b border-gray-200 flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile"
                        class="w-10 h-10 rounded-full object-cover">
                    <div class="ml-3">
                        <h3 class="font-medium">dorcas_</h3>
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
                <div class="flex-1 p-4 overflow-y-auto bg-gray-50 sr">
                    <!-- Incoming message -->
                    <div class="flex mb-4">
                        <img src="https://images.unsplash.com/photo-1686670798036-675839253a0f?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Profile" class="w-8 h-8 rounded-full object-cover mt-1">
                        <div class="ml-3">
                            <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs">
                                <p>Hey there! How's it going?</p>
                            </div>
                            <span class="text-xs text-gray-500 mt-1 block">10:30 AM</span>
                        </div>
                    </div>
                    <!-- Outgoing message -->
                    <div class="flex mb-4 justify-end">
                        <div class="mr-3 text-right">
                            <div class="bg-blue-500 text-white p-3 rounded-lg rounded-tr-none shadow-sm max-w-xs">
                                <p>I'm doing great! Just working on some new projects.</p>
                            </div>
                            <span class="text-xs text-gray-500 mt-1 block">10:32 AM <i
                                    class="fas fa-check ml-1 text-blue-500"></i></span>
                        </div>
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile"
                            class="w-8 h-8 rounded-full object-cover mt-1">
                    </div>

                    <div class="flex mb-4" v-for="value in 7">
                        <img src="https://images.unsplash.com/photo-1686670798036-675839253a0f?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Profile" class="w-8 h-8 rounded-full object-cover mt-1">
                        <div class="ml-3">
                            <div class="bg-white p-3 rounded-lg rounded-tl-none shadow-sm max-w-xs">
                                <p>Hey there! How's it going?</p>
                            </div>
                            <span class="text-xs text-gray-500 mt-1 block">10:30 AM</span>
                        </div>
                    </div>

                    <div class="flex mb-4 justify-end" v-for="value in 6">
                        <div class="mr-3 text-right">
                            <div class="bg-blue-500 text-white p-3 rounded-lg rounded-tr-none shadow-sm max-w-xs">
                                <p>I'm doing great! Just working on some new projects.</p>
                            </div>
                            <span class="text-xs text-gray-500 mt-1 block">10:32 AM <i
                                    class="fas fa-check ml-1 text-blue-500"></i></span>
                        </div>
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile"
                            class="w-8 h-8 rounded-full object-cover mt-1">
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
                        <input type="text" placeholder="Message..."
                            class="flex-1 bg-gray-100 rounded-full py-2 px-4 focus:outline-none">
                        <button
                            class="ml-2 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
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