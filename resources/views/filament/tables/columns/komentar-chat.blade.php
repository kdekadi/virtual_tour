<div style="display: flex; gap: 16px; padding: 16px; background-color: white; align-items: flex-start; min-width: 0;">
    <div style="flex-shrink: 0;">
        <div style="width: 38px; height: 38px; border-radius: 50%; background-color: #10b981; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
            <span style="color: white; font-weight: bold; font-size: 14px; text-transform: uppercase;">
                {{ substr($getRecord()->user->username ?? 'G', 0, 1) }}
            </span>
        </div>
    </div>

    <div style="flex: 1; min-width: 0;">
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
            <span style="font-weight: 700; font-size: 14px; color: #111827;">
                {{ $getRecord()->user->username ?? 'Guest' }}
            </span>
            <span style="font-size: 11px; color: #9ca3af;">
                • {{ $getRecord()->waktu_komentar?->diffForHumans() ?? '-' }}
            </span>
        </div>

        <div style="background-color: #f9fafb; padding: 10px 14px; border-radius: 8px; border: 1px solid #f3f4f6; color: #374151; font-size: 13px; line-height: 1.5; word-break: break-all;">
            {{ $getRecord()->isi_komentar }}
        </div>

        @if($getRecord()->parent_id)
            <div style="margin-top: 6px; font-size: 10px; color: #b45309; font-weight: 600;">
                ↳ Membalas ID: {{ $getRecord()->parent_id }}
            </div>
        @endif
    </div>
</div>