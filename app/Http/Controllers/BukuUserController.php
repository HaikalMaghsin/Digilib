<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class BukuUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Ensure only authenticated users can access admin routes
    // }
    public function index(Request $request)
    {
        // Cek apakah ada parameter kategori yang dikirim
        $kategori = $request->query('kategori');

        if ($kategori) {
            $jumlah_kunjungan = Kategori::where('nama_kategori', $kategori)->first();
            if ($jumlah_kunjungan) {
                $jumlah_kunjungan->increment('jumlah_kunjungan');
            }
            // Filter berdasarkan kategori jika parameter kategori ada
            $books = Book::whereHas('kategori', function ($query) use ($kategori) {
                $query->where('nama_kategori', $kategori);
            })->get();
        } else {
            // Tampilkan semua buku jika parameter kategori tidak ada
            $books = Book::all();
            $jumlah_kunjungan = null;
        }

        return view('dashboard', compact('books', 'jumlah_kunjungan'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Increment jumlah views
        $book->increment('views');

        // Cek apakah user sudah membeli buku dengan transaksi sukses
        $hasPurchased = false;
        if (auth()->check()) {
            $hasPurchased = Transaksi::where('user_id', auth()->id())
                ->where('buku_id', $id)
                ->where('status', 'success') // Sesuaikan dengan nama kolom di database
                ->exists();
        }

        // Return ke view detail buku
        return view('user.showbook', compact('book', 'hasPurchased'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        // Ambil term pencarian dari query string
        $searchTerm = $request->input('search');

        // Filter buku berdasarkan nama buku yang sesuai dengan search term
        $books = Book::where('nama_buku', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('result', compact('books', 'searchTerm'));
    }

    /**
 * Explore books with filters.
 */
public function explore(Request $request)
{
    $query = Book::query(); // Mulai query buku

    // Filter berdasarkan genre (jika tersedia)
    if ($request->has('genre') && $request->genre !== null) {
        $query->where('genre', $request->genre);
    }

    // Filter berdasarkan status (jika tersedia)
    if ($request->has('status') && $request->status !== null) {
        $query->where('status', $request->status); // Pastikan kolom 'status' ada di tabel
    }

    // Filter berdasarkan tipe (jika tersedia)
    if ($request->has('type') && $request->type !== null) {
        $query->where('type', $request->type); // Pastikan kolom 'type' ada di tabel
    }

    // Sort by berdasarkan parameter
    if ($request->has('sort_by') && $request->sort_by !== null) {
        $sortBy = $request->sort_by;
        switch ($sortBy) {
            case 'rating':
                $query->orderBy('rating', 'desc'); // Urutkan berdasarkan rating
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc'); // Urutkan berdasarkan yang terbaru
                break;
            case 'popular':
                $query->orderBy('popularity', 'desc'); // Urutkan berdasarkan popularitas
                break;
            default:
                $query->orderBy('nama_buku', 'asc'); // Default: urutkan berdasarkan nama
                break;
        }
    }

    // Dapatkan hasil setelah semua filter
    $books = $query->get();

    // Kirimkan hasil ke view explore
    return view('explore', compact('books'));
}

}
