<?php

namespace App\Livewire;

use Livewire\Component;

class KomentarSection extends Component
{
    public $isi_komentar = '';
    public $parent_id = null;

    public function postComment()
    {
        if (trim($this->isi_komentar) === '') {
        return;
    }
        $this->validate(['isi_komentar' => 'required']);

        \App\Models\Komentar::create([
            'isi_komentar' => $this->isi_komentar,
            'id_users' => auth()->id(),
            'parent_id' => $this->parent_id,
            'waktu_komentar' => now(),
        ]);

        $this->isi_komentar = ''; 
        $this->parent_id = null;
    }

    public function setReply($id) {
        $this->parent_id = $id;
    }

    public function render() {
        return view('livewire.komentar-section', [
            'comments' => \App\Models\Komentar::whereNull('parent_id')
                ->with('replies')
                ->orderBy('waktu_komentar', 'desc') 
                ->get()
        ]);
    }
}
