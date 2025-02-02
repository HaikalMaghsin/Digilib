<x-app-layout>
    <main class="max-w-6xl mx-auto mt-6 grid grid-cols-3 gap-8">
        {{-- Info Buku --}}
        <section class="bg-white p-6 rounded-lg shadow-md">
            {{-- Gambar Cover Buku --}}
            <div class="text-center">
                <img src="{{ asset('storage/' . $book->image_cover) }}" alt="{{ $book->nama_buku }}"
                    class="w-3/4 h-auto mx-auto rounded-lg border-2 border-[#377CC7] shadow-lg">
            </div>

            {{-- Judul Buku --}}
            <div class="mt-4 text-left">
                <h1 class="text-xl font-semibold text-gray-800"><strong>{{ $book->nama_buku }}</strong></h1>
            </div>

            {{-- Informasi Buku --}}
            <div class="mt-4 text-left">
                <p class="text-gray-700"><Strong>Rating:</Strong>
                    @if ($totalRaters > 0)
                        <div class="flex items-center space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($averageRating))
                                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z" />
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15.27L16.18 19l-1.64-7.03L19 7.24l-7.19-.61L10 0 8.19 6.63 1 7.24l5.46 4.73L4.82 19z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <p class="text-gray-700">{{ round($averageRating, 1) }} dari {{ $totalRaters }} perating</p>
                    @else
                        <p class="text-gray-700">Belum ada rating.</p>
                    @endif

                </p>
                <p class="text-gray-700">
                    <strong>Author:</strong> {{ $book->penulis }}
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Genre:</strong> {{ $book->genres->pluck('nama_genre')->join(', ') }}
                </p>
                <p class="text-gray-700 mt-1">
                    <strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}
                </p>
            </div>

            {{-- Tombol Reviews --}}
            <div class="mt-4">
                <a href="{{ route('ratekoment', ['id' => $book->id]) }}">
                    <button
                        class="px-4 py-2 bg-[#377CC7] text-white rounded-lg hover:bg-[#2d68a2] transition duration-300">
                        Reviews ({{ $komentview }})
                    </button>
                </a>
            </div>


            {{-- Tombol Kembali --}}
            <div class="mt-4">
                <a href="/home" class="text-[#377CC7] hover:underline">&larr; Kembali</a>
            </div>
        </section>

        {{-- Deskripsi Buku --}}
        <section class="bg-white p-6 rounded-lg shadow-md col-span-2 h-auto">
            <h2 class="text-lg font-bold mb-4">Deskripsi Buku</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $book->deskripsi }}
            </p>
        </section>

        {{-- Metode Pembayaran dan Transaksi --}}
        <section class="bg-white p-6 rounded-lg shadow-md col-span-3">
            <div class="flex flex-col space-y-4">
                {{-- Button Checkout --}}
                @if ($hasPurchased)
                    @if ($book->file_buku)
                        <a href="{{ asset('storage/' . $book->file_buku) }}"
                            class="px-4 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center justify-center transition duration-300"
                            download="{{ $book->nama_buku }}">
                            Unduh Buku
                        </a>
                    @else
                        <span class="px-4 py-3 bg-gray-400 text-white rounded-lg flex items-center justify-center">
                            File tidak tersedia
                        </span>
                    @endif
                @else
                    <a href="{{ route('transaksi.create', $book->id) }}"
                        class="px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center justify-center transition duration-300">
                        Check Out!
                    </a>
                @endif
                <form action="{{ route('cart.store') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="quantity" value="1" min="1" class="border p-2">
                    <button type="submit"
                        class="px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 flex items-center justify-center transition duration-300">
                        Cart
                    </button>
                </form>

                {{-- Rating Buku --}}
                <div class="star-rating">
                    <span data-value="1" class="star">&#9733;</span>
                    <span data-value="2" class="star">&#9733;</span>
                    <span data-value="3" class="star">&#9733;</span>
                    <span data-value="4" class="star">&#9733;</span>
                    <span data-value="5" class="star">&#9733;</span>
                </div>

                <!-- Form rating yang tersembunyi (untuk mengirim rating) -->
                <form id="rating-form" action="{{ route('book.rate', ['buku_id' => $book->id]) }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="rating" id="rating-input">
                    <button type="submit" id="submit-rating">Submit Rating</button>
                </form>
                <!-- End Form rating -->

                {{-- Komen Buku --}}
                <form action="{{ route('buku.komentar', ['buku_id' => $book->id]) }}" method="POST">
                    @csrf
                    <textarea name="komentar" class="w-full p-2 border rounded-lg" rows="3" placeholder="Tulis komentar..."></textarea>
                    <button type="submit"
                        class="mt-2 px-4 py-2 bg-[#377CC7] text-white rounded-lg hover:bg-[#2d68a2] transition duration-300">
                        Kirim Komentar
                    </button>
                </form>


            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-input');
            const ratingForm = document.getElementById('rating-form');
            const averageRatingElement = document.getElementById('average-rating');
            let selectedRating = 0;

            // Hover effect to highlight the stars
            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    const value = star.getAttribute('data-value');
                    setStars(value);
                });

                star.addEventListener('mouseout', () => {
                    setStars(selectedRating);
                });

                star.addEventListener('click', () => {
                    selectedRating = star.getAttribute('data-value');
                    ratingInput.value = selectedRating; // Set the selected rating to hidden input
                    ratingForm.submit(); // Submit the form after selecting the rating
                });
            });

            // Function to highlight stars based on rating
            function setStars(rating) {
                stars.forEach(star => {
                    const value = star.getAttribute('data-value');
                    if (value <= rating) {
                        star.style.color = 'gold'; // Highlight with gold color
                    } else {
                        star.style.color = 'gray'; // Reset other stars to gray
                    }
                });
            }

            // Inisialisasi dengan menampilkan rating yang sudah dipilih (jika ada)
            if (selectedRating > 0) {
                setStars(selectedRating);
            }
        });
    </script>
</x-app-layout>
