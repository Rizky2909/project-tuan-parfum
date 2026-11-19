<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parfum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seed data untuk akun Admin dan sampel produk Parfum.
     * Dibuat rapi dan terstruktur agar mudah dipahami.
     */
    public function run(): void
    {
        // 1. Akun Admin (Email: admin@tuanparfum.com atau username: admin, Password: admin)
        User::updateOrCreate(
            ['email' => 'admin@tuanparfum.com'],
            [
                'name'     => 'Admin Tuan Parfum',
                'password' => Hash::make('admin'),
                'role'     => 'admin',
            ]
        );

        // 2. Akun Kurir (Email: kurir@tuanparfum.com, Password: kurir)
        User::updateOrCreate(
            ['email' => 'kurir@tuanparfum.com'],
            [
                'name'     => 'Kurir Tuan Parfum',
                'password' => Hash::make('kurir'),
                'role'     => 'kurir',
            ]
        );

        // 3. Akun Pelanggan Contoh (Email: pelanggan@tuanparfum.com, Password: 123)
        User::updateOrCreate(
            ['email' => 'pelanggan@tuanparfum.com'],
            [
                'name'     => 'Pelanggan Setia',
                'password' => Hash::make('123'),
                'role'     => 'pelanggan',
            ]
        );

        // 4. Sampel Produk Parfum dengan Golden Placeholder Luxury
        $parfums = [
            [
                'nama'      => 'Oud Imperial Extrait',
                'kategori'  => 'Unisex',
                'volume'    => 100,
                'harga'     => 650000,
                'stok'      => 20,
                'deskripsi' => 'Perpaduan agarwood Kamboja langka dengan sentuhan amber resin dan vanilla madagascar hangat.',
                'foto'      => null, // Sengaja kosong agar menggunakan golden luxury background
            ],
            [
                'nama'      => 'Santal Velvet',
                'kategori'  => 'Pria',
                'volume'    => 100,
                'harga'     => 520000,
                'stok'      => 15,
                'deskripsi' => 'Keharuman kayu cendana Mysore berpadu dengan rempah kapulaga dan cedarwood elegan.',
                'foto'      => null,
            ],
            [
                'nama'      => 'Rose Ébène',
                'kategori'  => 'Wanita',
                'volume'    => 100,
                'harga'     => 580000,
                'stok'      => 18,
                'deskripsi' => 'Mawar damaskus misterius yang dipadukan dengan kayu eboni gelap dan sentuhan patchouli lembut.',
                'foto'      => null,
            ],
            [
                'nama'      => 'Bergamot Drift',
                'kategori'  => 'Unisex',
                'volume'    => 100,
                'harga'     => 480000,
                'stok'      => 25,
                'deskripsi' => 'Kesegaran bergamot Calabria dengan aroma laut segar dan sentuhan vetiver aromatik.',
                'foto'      => null,
            ],
        ];

        foreach ($parfums as $item) {
            Parfum::updateOrCreate(
                ['nama' => $item['nama']],
                $item
            );
        }
    }
}
