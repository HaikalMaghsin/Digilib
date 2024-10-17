<x-app-layout>
    <div class="w-full mx-auto bg-white shadow-md p-6 border-l-4 border-white">
        <!-- Search Bar -->
        <div class="flex items-center mb-6 bg-gray-200 p-2 rounded-full">
            <div class="flex w-full items-center bg-gray-200 p-1 rounded-full">
                <input type="text" placeholder="Search"
                    class="flex-grow p-2 bg-white-200 focus:outline-none rounded-full focus:ring-0">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

        </div>

        <!-- Tabs for Category -->

        <div class="flex justify-center space-x-2 mb-6">
            <!-- Manga Button -->
            <button
                class="px-6 py-2 rounded-full transition duration-300 bg-gray-200 text-gray-700 hover:bg-blue-500 hover:text-white focus:bg-blue-600 focus:text-white">
                Manga
            </button>

            <!-- Novel Button -->
            <button
                class="ml-2 px-6 py-2 rounded-full transition duration-300 bg-sky-400 text-white hover:bg-gray-400 hover:text-black">
                Novel
            </button>


        </div>

        <!-- Title -->
        <h2 class="text-xl font-bold mb-6 text-center">Mass Released !!</h2>

        <!-- Content Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Example Item with Image -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/150" alt="Roshidere" class="w-full h-48 object-cover">
                <div class="p-2 bg-blue-500 text-black text-center">
                    Roshidere
                </div>
            </div>

            <!-- Empty Slots to be filled dynamically -->
            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                <p>Empty Slot</p>
            </div>
            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                <p>Empty Slot</p>
            </div>
            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                <p>Empty Slot</p>
            </div>
        </div>
    </div>
</x-app-layout>
