<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatRoom extends Component
{
    public $selectedUser = null;
    public $message = '';

    // Menentukan listener agar chat bisa di-refresh otomatis (opsional)
    protected $listeners = ['refreshChat' => '$refresh'];

    public function selectUser($username)
    {
        $this->selectedUser = $username;
    }

    public function sendMessage()
    {
        if (empty(trim($this->message)) || !$this->selectedUser) {
            return;
        }

        Chat::create([
            'sender_username'   => Auth::user()->name,
            'receiver_username' => $this->selectedUser,
            'message'           => $this->message,
            'sent_at'           => now(),
        ]);

        $this->message = ''; // Reset input field
    }

    public function render()
    {
        // Mengambil semua user kecuali diri sendiri
        $users = User::where('name', '!=', Auth::user()->name)->get();
        
        $chats = [];
        if ($this->selectedUser) {
            $chats = Chat::where(function($query) {
                $query->where('sender_username', Auth::user()->name)
                      ->where('receiver_username', $this->selectedUser);
            })->orWhere(function($query) {
                $query->where('sender_username', $this->selectedUser)
                      ->where('receiver_username', Auth::user()->name);
            })->orderBy('sent_at', 'asc')->get();
        }

        return view('livewire.chat-room', [
            'users' => $users,
            'chats' => $chats
        ]);
    }
}