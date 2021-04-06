<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;


class Chats extends Component
{
    public $chats, $body, $chat_id;

    public function render()
    {
        $this->chats = Chat::join('users', 'chats.user_id', '=', 'users.id')->orderBy('created_at', 'desc')->limit(10)->get(['chats.*', 'users.name']);
        return view('livewire.chats');
    }

    public function resetInputField() {
        $this->body = '';
    }

    public function send() {
        $this->validate([
            'body' => "required|max:100"
        ]);

        $chat = Chat::create([
            'body' => $this->body,
            'user_id' => Auth::user()->id
        ]);

        session()->flash('message', $chat ? 'Success.' : 'Failed.');
        $this->resetInputField();
        
    }
}
