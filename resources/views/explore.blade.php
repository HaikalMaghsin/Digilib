<x-app-layout>
    <div class="min-w-full overflow-hidden mx-auto px-4">
        <div class="container bg-gradient-to-tl from-sky-500 to-transparent border-2 rounded-xl px-4 py-3 mx-2 w-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <h1 class="text-3xl font-bold text-center sm:text-left mb-2 sm:mb-0">
                    Daftar Buku
                </h1>
            </div>
            
            <!-- Tombol Filter -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-4 sm:space-y-0">
                <div class="flex flex-wrap justify-center sm:justify-start space-x-2 space-y-2 sm:space-y-0">
                    <button class="bg-slate-300 text-slate-700 font-bold text-sm px-4 py-2 rounded">Genre <i class="fas fa-caret-down"></i></button>
                    <button class="bg-slate-300 text-slate-700 font-bold text-sm px-4 py-2 rounded">Status <i class="fas fa-caret-down"></i></button>
                    <button class="bg-slate-300 text-slate-700 font-bold text-sm px-3 py-2 rounded">Type <i class="fas fa-caret-down"></i></button>
                    <button class="bg-slate-300 text-slate-700 font-bold text-sm px-3 py-2 rounded">Sort By <i class="fas fa-caret-down"></i></button>
                    <button class="bg-slate-300 text-slate-700 font-bold text-sm px-4 py-2 rounded flex items-center">
                        <i class="fa-solid fa-filter mr-1"></i> Filter
                    </button>
                </div>
                <div class="w-full sm:w-auto">
                    <input class="bg-slate-300 text-slate-700 font-bold text-sm px-4 py-2 rounded w-full" placeholder="Cari" type="text" />
                </div>
            </div>
            
            <!-- Grid Buku -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 gap-y-8 max-h-[calc(5*12rem)] overflow-y-auto">
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <a href="{{ route('buku.show', $book->id) }}" class="block w-52">
                            <div class="bg-white p-2 rounded shadow-md hover:shadow-lg">
                                <!-- Sampul Buku -->
                                <img 
                                    alt="{{ $book->nama_buku }}" 
                                    class="w-full h-48 object-cover rounded border-2 border-slate-900"
                                    src="{{ $book->image_cover ? asset('storage/' . $book->image_cover) : asset('img/default-book.jpg') }}" 
                                />
                                
                                <!-- Genre -->
                                <div class="flex justify-between items-center mt-2">
                                    <span class="bg-red-600 text-white font-bold px-2 py-1 text-xs rounded">
                                        {{ $book->genres->pluck('nama_genre')->join(', ') }}
                                    </span>
                                </div>
                                
                                <!-- Nama Buku -->
                                <h2 class="mt-2 text-sm font-semibold truncate">{{ $book->nama_buku }}</h2>
                                
                                <!-- Deskripsi Buku -->
                                <p class="text-xs mt-2 text-gray-400 line-clamp-2">{{ $book->deskripsi }}</p>
                                
                                <!-- Rating -->
                                <div class="flex items-center mt-2">
                                    @php
                                        $fullStars = floor($book->rating);
                                        $halfStar = $book->rating - $fullStars >= 0.5;
                                    @endphp
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $fullStars)
                                            <i class="fas fa-star text-yellow-500"></i>
                                        @elseif ($i === $fullStars && $halfStar)
                                            <i class="fas fa-star-half-alt text-yellow-500"></i>
                                        @else
                                            <i class="far fa-star text-yellow-500"></i>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-xs">{{ number_format($book->rating, 2) }}</span>
                                </div>
                                
                                <!-- Harga -->
                                <p class="text-xs mt-2 text-gray-400 font-semibold">
                                    Rp{{ number_format($book->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-gray-500">Tidak ada buku yang ditemukan.</p>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>
