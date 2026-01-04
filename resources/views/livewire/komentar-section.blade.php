<div class="max-w-4xl mx-auto mt-4 px-2" x-data="{ showAll: false, expandedReplies: [] }">
    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 mb-4 shadow-sm">
        <div class="relative">
            <textarea wire:model="isi_komentar" 
                class="w-full min-h-[80px] bg-white rounded-lg border border-gray-200 px-3 py-2 text-sm outline-none focus:ring-1 focus:ring-green-500 transition-all resize-none shadow-sm"
                placeholder="{{ $parent_id ? 'Membalas komentar...' : 'Tulis komentar...' }}"></textarea>

            <div class="flex justify-between items-center mt-2">
                <div>
                    @guest
                        <span class="text-[10px] text-red-500 font-medium">Kamu harus <a href="{{ route('login') }}" class="underline font-bold">Login</a> dahulu untuk berkirim komentar.</span>
                    @endguest
                    
                    @if($parent_id)
                        <div class="flex items-center gap-2">
                            @php
                                $targetComment = $comments->firstWhere('id_komentar', $parent_id);
                                $targetUsername = $targetComment->user->username ?? 'User';
                            @endphp
                            <span class="text-[10px] text-gray-500 italic">
                                Membalas <span class="font-bold text-green-600">@ {{ $targetUsername }}</span>
                            </span>
                            <button wire:click="$set('parent_id', null)" class="text-[10px] text-red-500 hover:underline">✕ Batal</button>
                        </div>
                    @endif
                </div>
                
                @auth
                    <button wire:click="postComment" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm">Kirim ➤</button>
                @else
                    <a href="{{ route('login') }}" class="bg-gray-400 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm">Kirim ➤</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm">
        <div class="inline-block border border-green-600 text-green-600 px-3 py-0.5 rounded-full text-[10px] font-bold mb-4 tracking-wider">Diskusi</div>

        <div class="space-y-4">
            @forelse($comments as $index => $comment)
                <div x-show="showAll || {{ $index }} < 5" wire:key="comment-{{ $comment->id_komentar }}">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center text-white font-bold text-xs shadow-sm border border-gray-100">
                                {{ substr($comment->user->username ?? 'G', 0, 1) }}
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-2 leading-none">
                                <span class="font-bold text-xs text-gray-800">{{ $comment->user->username ?? 'Guest' }}</span>
                                @if($comment->user && $comment->user->role === 'admin')
                                    <span class="bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded text-[8px] font-extrabold tracking-tighter">Admin</span>
                                @endif
                                <span class="text-[10px] text-gray-400">{{ $comment->waktu_komentar->diffForHumans() }}</span>
                            </div>

                            <p class="text-xs text-gray-700 mt-1 leading-snug">{{ $comment->isi_komentar }}</p>

                            <button wire:click="setReply({{ $comment->id_komentar }}, '{{ $comment->user->username ?? 'User' }}')" 
                                    class="text-[10px] font-bold text-gray-400 hover:text-green-600 mt-1 transition-colors">
                                Balas
                            </button>

                            @if($comment->replies && $comment->replies->count() > 0)
                                <div class="mt-2">
                                    <button @click="expandedReplies.includes({{ $comment->id_komentar }}) ? expandedReplies = expandedReplies.filter(i => i !== {{ $comment->id_komentar }}) : expandedReplies.push({{ $comment->id_komentar }})" 
                                            class="text-[10px] text-green-600 font-bold flex items-center gap-1 hover:underline">
                                        <span x-text="expandedReplies.includes({{ $comment->id_komentar }}) ? 'Sembunyikan Balasan' : 'Lihat ' + {{ $comment->replies->count() }} + ' Balasan'"></span>
                                    </button>

                                    <div x-show="expandedReplies.includes({{ $comment->id_komentar }})" x-transition class="mt-3 space-y-3 ml-1 border-l-2 border-gray-100 pl-4">
                                        @foreach($comment->replies as $reply)
                                            <div class="flex gap-2" wire:key="reply-{{ $reply->id_komentar }}">
                                                <div class="flex-shrink-0">
                                                    <div class="w-6 h-6 rounded-full bg-black flex items-center justify-center text-white font-bold text-[9px] shadow-sm border border-gray-200">
                                                        {{ substr($reply->user->username ?? 'U', 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 leading-none">
                                                        <span class="font-bold text-[11px] text-gray-800">{{ $reply->user->username ?? 'User' }}</span>
                                                        @if($reply->user && $reply->user->role === 'admin')
                                                            <span class="bg-blue-100 text-blue-600 px-1 py-0.5 rounded text-[7px] font-extrabold tracking-tighter">Admin</span>
                                                        @endif
                                                        <span class="text-[9px] text-gray-400">{{ $reply->waktu_komentar->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-[11px] text-gray-600 mt-0.5 leading-normal">
                                                        <span class="text-green-600 font-bold">@ {{ $comment->user->username }}</span> {{ $reply->isi_komentar }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-6">
                    <p class="text-gray-400 text-[11px]">Belum ada diskusi.</p>
                </div>
            @endforelse

            @if(count($comments) > 5)
                <button x-show="!showAll" @click="showAll = true" class="w-full py-2 mt-2 text-xs font-bold text-gray-500 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all tracking-widest">
                    Tampilkan {{ count($comments) - 5 }} Komentar Lainnya...
                </button>
                <button x-show="showAll" @click="showAll = false" class="w-full py-2 mt-2 text-xs font-bold text-gray-500 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all tracking-widest">
                    Sembunyikan Komentar
                </button>
            @endif
        </div>
    </div>
</div>