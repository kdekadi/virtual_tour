<div class="max-w-4xl mx-auto mt-4 px-2">
    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 mb-4">
        <div class="relative">
            <textarea wire:model="isi_komentar"
                class="w-full min-h-[80px] bg-white rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-1 focus:ring-green-500 transition-all resize-none shadow-sm"
                placeholder="{{ $parent_id ? 'Membalas komentar...' : 'Tulis komentar...' }}"></textarea>

            <div class="flex justify-between items-center mt-2">
                @if($parent_id)
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] text-gray-500 italic">Mode membalas aktif</span>
                        <button wire:click="$set('parent_id', null)" class="text-[10px] text-red-500 hover:underline">
                            ✕ Batal
                        </button>
                    </div>
                @else
                    <div></div>
                @endif

                <button wire:click="postComment"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm">
                    Kirim ➤
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm">
        <div class="inline-block border border-green-600 text-green-600 px-3 py-0.5 rounded-full text-[10px] font-bold mb-4">
            Komentar
        </div>

        <div class="space-y-4">
            @forelse($comments as $comment)
                {{-- wire:key sangat penting agar Livewire bisa melacak elemen --}}
                <div class="flex gap-3" wire:key="comment-{{ $comment->id_komentar }}">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-red-400 flex items-center justify-center text-white font-bold text-xs shadow-sm uppercase">
                            {{ substr($comment->user->username ?? 'G', 0, 1) }}
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-2 leading-none">
                            <span class="font-bold text-xs text-gray-800">{{ $comment->user->username ?? 'Guest' }}</span>
                            <span class="text-[10px] text-gray-400">{{ $comment->waktu_komentar->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-gray-700 mt-1 leading-snug">{{ $comment->isi_komentar }}</p>

                        <button wire:click="setReply({{ $comment->id_komentar }})"
                            class="text-[10px] font-bold text-gray-400 hover:text-green-600 mt-1 transition-colors">
                            Balas
                        </button>

                        @if($comment->replies && $comment->replies->count() > 0)
                            <div class="mt-3 space-y-3 ml-1 border-l-2 border-gray-50 pl-4">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-2" wire:key="reply-{{ $reply->id_komentar }}">
                                        <div class="w-6 h-6 rounded-full bg-yellow-500 flex items-center justify-center text-white font-bold text-[9px] uppercase shadow-sm">
                                            {{ substr($reply->user->username ?? 'A', 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 leading-none">
                                                <span class="font-bold text-[11px] text-gray-800">{{ $reply->user->username ?? 'Admin' }}</span>
                                                <span class="text-[9px] text-gray-400">{{ $reply->waktu_komentar ? $reply->waktu_komentar->diffForHumans() : '' }}</span>
                                            </div>
                                            <p class="text-[11px] text-gray-600 mt-0.5">{{ $reply->isi_komentar }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                @if(!$loop->last)
                    <div class="h-[1px] bg-gray-50 w-full my-1"></div>
                @endif

            @empty
                <div class="text-center py-6">
                    <p class="text-gray-400 text-[11px]">Belum ada diskusi di sini. Jadilah yang pertama!</p>
                </div>
            @endforelse
        </div>

        {{-- @if($comments->count() > 5)
            <button class="text-green-600 text-[10px] font-bold mt-4 inline-block hover:underline">
                Lihat komentar lainnya >>
            </button>
        @endif --}}
    </div>
</div>