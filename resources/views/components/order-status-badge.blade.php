@props(['status'])

@php
  $labels = [
      'menunggu_pembayaran' => 'Menunggu Pembayaran',
      'menunggu_verifikasi' => 'Menunggu Verifikasi',
      'diproses'            => 'Sedang Diproses',
      'dikirim'             => 'Dalam Pengiriman',
      'selesai'             => 'Pesanan Selesai',
      'dibatalkan'          => 'Dibatalkan',
  ];

  $classes = [
      'menunggu_pembayaran' => 'bg-amber-500/10 border-amber-500/30 text-amber-300',
      'menunggu_verifikasi' => 'bg-indigo-500/10 border-indigo-500/30 text-indigo-300',
      'diproses'            => 'bg-[#C9A227]/10 border-[#C9A227]/30 text-[#C9A227]',
      'dikirim'             => 'bg-sky-500/10 border-sky-500/30 text-sky-300',
      'selesai'             => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300',
      'dibatalkan'          => 'bg-rose-500/10 border-rose-500/30 text-rose-300',
  ];

  $label = $labels[$status] ?? ucfirst(str_replace('_', ' ', $status));
  $badgeClass = $classes[$status] ?? 'bg-white/10 border-white/20 text-[#E6E9EF]';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-sm border text-[11px] font-medium tracking-wider uppercase {$badgeClass}"]) }}>
  {{ $label }}
</span>
