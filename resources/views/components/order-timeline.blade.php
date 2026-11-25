@props(['logs' => []])

<div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-[1px] before:bg-white/10">
  @forelse($logs as $log)
    <div class="relative group">
      <!-- Dot indicator -->
      <div class="absolute -left-6 top-1 w-3 h-3 rounded-full bg-[#101623] border border-[#C9A227] flex items-center justify-center">
        <div class="w-1 h-1 rounded-full bg-[#C9A227]"></div>
      </div>

      <div class="space-y-1">
        <div class="flex items-center gap-2">
          <x-order-status-badge :status="$log->status" />
          <span class="text-[11px] text-[#9AA3B2] font-mono tabular-nums">
            {{ $log->created_at ? $log->created_at->format('d M Y, H:i') : '-' }} WIB
          </span>
        </div>
        <p class="text-xs text-[#E6E9EF] leading-relaxed font-light">
          {{ $log->keterangan }}
        </p>
        @if($log->changer)
          <span class="text-[10px] text-[#9AA3B2]/80 block">
            Oleh: {{ $log->changer->name }} ({{ ucfirst($log->changer->role) }})
          </span>
        @endif
      </div>
    </div>
  @empty
    <p class="text-xs text-[#9AA3B2]">Belum ada riwayat aktivitas tercatat.</p>
  @endforelse
</div>
