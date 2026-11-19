<?php

namespace App\Http\Controllers;

use App\Models\Parfum;
use Illuminate\Http\Request;

class ParfumController extends Controller
{
    /**
     * Menampilkan daftar semua produk parfum untuk Admin
     */
    public function index()
    {
        // Mengambil data parfum terbaru dari database
        $parfums = Parfum::latest()->get();

        return view('pages.admin.parfum', compact('parfums'));
    }

    /**
     * Menampilkan formulir penambahan parfum baru
     */
    public function create()
    {
        return view('pages.admin.parfum-form');
    }

    /**
     * Menyimpan produk parfum baru ke dalam database
     * Ditulis mudah dipahami untuk level mahasiswa.
     */
    public function store(Request $request)
    {
        // 1. Validasi data input form
        $validatedData = $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string',
            'volume'    => 'required|integer|min:1',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama.required'     => 'Nama parfum wajib diisi.',
            'kategori.required' => 'Pilih kategori wewangian.',
            'harga.required'    => 'Harga parfum wajib diisi.',
            'stok.required'     => 'Jumlah stok wajib diisi.',
        ]);

        // 2. Upload file foto jika admin mengunggahnya
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/parfums'), $fileName);
            $validatedData['foto'] = 'images/parfums/' . $fileName;
        } else {
            // Jika kosong, set null agar background golden luxury default yang tampil
            $validatedData['foto'] = null;
        }

        // 3. Simpan data ke tabel parfums
        Parfum::create($validatedData);

        return redirect()->route('admin.parfum')
            ->with('success', 'Produk wewangian "' . $validatedData['nama'] . '" berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir edit parfum
     */
    public function edit($id)
    {
        $parfum = Parfum::findOrFail($id);
        return view('pages.admin.parfum-form', compact('parfum', 'id'));
    }

    /**
     * Memperbarui data parfum yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $parfum = Parfum::findOrFail($id);

        $validatedData = $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string',
            'volume'    => 'required|integer|min:1',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/parfums'), $fileName);
            $validatedData['foto'] = 'images/parfums/' . $fileName;
        }

        $parfum->update($validatedData);

        return redirect()->route('admin.parfum')
            ->with('success', 'Data parfum berhasil diperbarui.');
    }

    /**
     * Menghapus produk parfum
     */
    public function destroy($id)
    {
        $parfum = Parfum::findOrFail($id);
        $parfum->delete();

        return redirect()->route('admin.parfum')
            ->with('success', 'Produk parfum telah dihapus.');
    }
}
