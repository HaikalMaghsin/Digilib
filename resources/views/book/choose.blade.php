<x-app-layout>
    <div class="max-w-5xl mx-auto mt-6 grid grid-cols-3 gap-6">
        {{-- info buku --}}
        <div class="bg-gray-100 ml-3 p-7 max-w-xs mx-auto">
            {{-- gambar cover buku --}}
            <div class="relative">
                <img src="{{ asset('storage/' . $book->image_cover) }}" alt="{{ $book->nama_buku }}"
                    class="w-2/3 h-auto mx-0 rounded-lg border-2 border-[#377CC7] shadow-lg">
            </div>
            {{-- judul buku --}}
            <div class="">
                <h2 class="bottom-0 mb-4 text-lg text-black">{{ $book->nama_buku }}</h2>
            </div>
            {{-- informasi buku --}}
            <div class="mt-2 text-left pl-2">
                <p class="text-gray-700">
                    <strong>Rating:</strong>
                    <span class="text-yellow-500">{{ str_repeat('★', $book->rating) }}</span>
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Author:</strong> 
                    {{ $book->penulis }}
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Genre:</strong> 
                    {{ $book->genres->pluck('nama_genre')->join(', ') }}
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                </p>
                {{-- tombol reviews --}}
                <br>
                <button class="px-4 py-2 bg-[#377CC7] text-white rounded hover:bg-[#2d68a2]">
                    Reviews (200)
                </button>
                <br><br>
                {{-- tombol kembali --}}
                <a href="/dashboard" class="text-[#377CC7] hover:underline">&larr; Kembali</a>
            </div>
        </div>
    
        {{-- deskripsi buku --}}
        <div class="bg-white p-4 mt-6 rounded shadow col-span-1 h-[32rem] mr-2">
            <h2 class="text-lg font-bold mb-4">Deskripsi Buku</h2>
            <p class="text-gray-700">
                {{ $book->deskripsi }}
            </p>
        </div>
    
        {{-- metode pembayaran dan checkout --}}
        <div x-data="{ metodePembayaran: '' }" class="flex flex-col space-y-6 mt-6 pr-8">
            <div class="bg-white p-4 h-fit rounded shadow">
                <h2 class="text-lg font-bold mb-4">Metode Pembayaran</h2>
                <div class="grid grid-cols-3 justify-items-center">
                    <a href="#" @click.prevent="metodePembayaran = 'Gopay'" class="cursor-pointer">
                        <img src="{{ asset('img/gopay.png') }}" alt="Gopay" 
                             class="w-17 h-14 border-2 rounded"
                             :class="{ 'border-blue-500': metodePembayaran === 'Gopay', 'border-transparent': metodePembayaran !== 'Gopay' }">
                    </a>
                    <a href="#" @click.prevent="metodePembayaran = 'BCA'" class="cursor-pointer">
                        <img src="{{ asset('img/bca.png') }}" alt="BCA" 
                             class="w-24 h-13 border-2 rounded"
                             :class="{ 'border-blue-500': metodePembayaran === 'BCA', 'border-transparent': metodePembayaran !== 'BCA' }">
                    </a>
                    <a href="#" @click.prevent="metodePembayaran = 'BNI'" class="cursor-pointer">
                        <img src="{{ asset('img/bni.png') }}" alt="BNI" 
                             class="w-24 h-13 border-2 rounded"
                             :class="{ 'border-blue-500': metodePembayaran === 'BNI', 'border-transparent': metodePembayaran !== 'BNI' }">
                    </a>
                    <a href="#" @click.prevent="metodePembayaran = 'Maestro'" class="cursor-pointer">
                        <img src="{{ asset('img/maestro.png') }}" alt="Maestro" 
                             class="w-11 h-10 mt-2 border-2 rounded"
                             :class="{ 'border-blue-500': metodePembayaran === 'Maestro', 'border-transparent': metodePembayaran !== 'Maestro' }">
                    </a>
                </div>
            </div>
    
            {{-- detail transaksi --}}
            <div class="bg-white p-6 rounded shadow">
                <div class="mt-6 flex flex-col space-y-2">
                    {{-- button check out --}}
                    <a href="/transaksi/{{ $book->id }}" 
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 flex items-center justify-center"
                        :class="{ 'opacity-50 cursor-not-allowed': !metodePembayaran }"
                        :disabled="!metodePembayaran">
                         Check Out!
                     </a>
                     
                    {{-- button wishlist --}}
                    <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Wishlist</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>