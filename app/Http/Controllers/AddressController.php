<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Tampilkan daftar buku alamat pelanggan
     */
    public function index()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        return view('pages.pelanggan.alamat', compact('addresses'));
    }

    /**
     * Simpan alamat baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'          => 'nullable|string|max:50',
            'nama_penerima'  => 'required|string|max:100',
            'no_hp'          => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kecamatan'      => 'required|string|max:100',
            'kota'           => 'required|string|max:100',
            'kode_pos'       => 'nullable|string|max:10',
            'patokan'        => 'nullable|string|max:255',
            'is_default'     => 'nullable|boolean',
        ], [
            'nama_penerima.required'  => 'Nama penerima wajib diisi.',
            'no_hp.required'          => 'Nomor telepon/WhatsApp wajib diisi.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'kecamatan.required'      => 'Kecamatan wajib diisi.',
            'kota.required'           => 'Kota wajib diisi.',
        ]);

        $user = Auth::user();
        $isFirst = Address::where('user_id', $user->id)->count() === 0;
        $isDefault = $isFirst || !empty($validated['is_default']);

        if ($isDefault) {
            Address::where('user_id', $user->id)->update(['is_default' => false]);
        }

        $address = Address::create([
            'user_id'        => $user->id,
            'label'          => $validated['label'] ?: 'Rumah',
            'nama_penerima'  => $validated['nama_penerima'],
            'no_hp'          => $validated['no_hp'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'kecamatan'      => $validated['kecamatan'],
            'kota'           => $validated['kota'],
            'kode_pos'       => $validated['kode_pos'] ?? null,
            'patokan'        => $validated['patokan'] ?? null,
            'is_default'     => $isDefault,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Alamat pengiriman berhasil ditambahkan.',
                'address' => $address,
            ]);
        }

        return back()->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    /**
     * Perbarui alamat yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $validated = $request->validate([
            'label'          => 'nullable|string|max:50',
            'nama_penerima'  => 'required|string|max:100',
            'no_hp'          => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kecamatan'      => 'required|string|max:100',
            'kota'           => 'required|string|max:100',
            'kode_pos'       => 'nullable|string|max:10',
            'patokan'        => 'nullable|string|max:255',
            'is_default'     => 'nullable|boolean',
        ]);

        $isDefault = !empty($validated['is_default']);
        if ($isDefault) {
            Address::where('user_id', $user->id)->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $address->update([
            'label'          => $validated['label'] ?: $address->label,
            'nama_penerima'  => $validated['nama_penerima'],
            'no_hp'          => $validated['no_hp'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'kecamatan'      => $validated['kecamatan'],
            'kota'           => $validated['kota'],
            'kode_pos'       => $validated['kode_pos'] ?? null,
            'patokan'        => $validated['patokan'] ?? null,
            'is_default'     => $isDefault || $address->is_default,
        ]);

        return back()->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Jadikan sebagai alamat default
     */
    public function setDefault($id)
    {
        $user = Auth::user();
        Address::where('user_id', $user->id)->update(['is_default' => false]);
        Address::where('user_id', $user->id)->where('id', $id)->update(['is_default' => true]);

        return back()->with('success', 'Alamat utama berhasil diatur.');
    }

    /**
     * Hapus alamat
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        $wasDefault = $address->is_default;
        $address->delete();

        // Jika alamat default dihapus, jadikan alamat lain sebagai default
        if ($wasDefault) {
            $otherAddress = Address::where('user_id', $user->id)->first();
            if ($otherAddress) {
                $otherAddress->update(['is_default' => true]);
            }
        }

        return back()->with('success', 'Alamat berhasil dihapus.');
    }
}
