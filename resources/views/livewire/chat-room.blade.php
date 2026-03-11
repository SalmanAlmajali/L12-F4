<div class="chat-shell flex flex-col md:flex-row h-[680px] w-full overflow-hidden rounded-2xl shadow-2xl" style="font-family: 'DM Sans', sans-serif; background: #f0f6ff;">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap');

        .chat-shell {
            border: 1px solid #c7dff7;
        }

        /* Sidebar */
        .chat-sidebar {
            background: linear-gradient(180deg, #1a56db 0%, #1e40af 100%);
            width: 260px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .chat-sidebar-header {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .chat-sidebar-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.55);
            margin-bottom: 16px;
        }

        .chat-search {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 8px 12px;
            color: white;
            font-size: 13px;
            width: 100%;
            outline: none;
            transition: background 0.2s;
        }

        .chat-search::placeholder { color: rgba(255,255,255,0.45); }
        .chat-search:focus { background: rgba(255,255,255,0.18); }

        .chat-user-list {
            flex: 1;
            overflow-y: auto;
            padding: 8px 10px;
        }

        .chat-user-list::-webkit-scrollbar { width: 4px; }
        .chat-user-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        .user-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.15s;
            margin-bottom: 2px;
        }

        .user-item:hover { background: rgba(255,255,255,0.1); }
        .user-item.active { background: rgba(255,255,255,0.18); }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .user-item.active .user-avatar {
            background: white;
            color: #1a56db;
        }

        .user-info-name {
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.92);
        }

        .user-item.active .user-info-name { color: white; font-weight: 600; }

        .online-dot {
            width: 7px; height: 7px;
            background: #4ade80;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.5);
            flex-shrink: 0;
            margin-left: auto;
        }

        /* Main chat area */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f8faff;
            min-width: 0;
        }

        .chat-topbar {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 24px;
            background: white;
            border-bottom: 1px solid #dbeafe;
            box-shadow: 0 1px 8px rgba(59,130,246,0.06);
        }

        .chat-topbar-avatar {
            width: 42px; height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 700; color: white;
            flex-shrink: 0;
        }

        .chat-topbar-name {
            font-size: 16px;
            font-weight: 600;
            color: #1e3a5f;
        }

        .chat-topbar-status {
            font-size: 12px;
            color: #4ade80;
            font-weight: 500;
        }

        .chat-topbar-empty {
            font-size: 16px;
            font-weight: 600;
            color: #1e3a5f;
        }

        /* Messages */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .chat-messages::-webkit-scrollbar { width: 5px; }
        .chat-messages::-webkit-scrollbar-thumb { background: #bfdbfe; border-radius: 5px; }

        .msg-row { display: flex; }
        .msg-row.mine { justify-content: flex-end; }
        .msg-row.theirs { justify-content: flex-start; }

        .msg-bubble {
            max-width: 68%;
            padding: 10px 16px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.5;
        }

        .msg-row.mine .msg-bubble {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border-bottom-right-radius: 4px;
            box-shadow: 0 4px 14px rgba(29,78,216,0.25);
        }

        .msg-row.theirs .msg-bubble {
            background: white;
            color: #1e3a5f;
            border-bottom-left-radius: 4px;
            border: 1px solid #dbeafe;
            box-shadow: 0 2px 8px rgba(59,130,246,0.08);
        }

        .msg-time {
            font-size: 10px;
            opacity: 0.65;
            display: block;
            margin-top: 4px;
            text-align: right;
        }

        .msg-row.theirs .msg-time { text-align: left; }

        /* Empty state */
        .chat-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #93c5fd;
        }

        .chat-empty-icon {
            width: 64px; height: 64px;
            background: #eff6ff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 8px;
        }

        .chat-empty h3 { font-size: 16px; font-weight: 600; color: #3b82f6; margin: 0; }
        .chat-empty p { font-size: 13px; color: #93c5fd; margin: 0; }

        /* Input */
        .chat-input-area {
            padding: 16px 24px;
            background: white;
            border-top: 1px solid #dbeafe;
        }

        .chat-input-row {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f0f6ff;
            border: 1.5px solid #bfdbfe;
            border-radius: 14px;
            padding: 8px 8px 8px 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .chat-input-row:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }

        .chat-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 14px;
            color: #1e3a5f;
            font-family: 'DM Sans', sans-serif;
        }

        .chat-input::placeholder { color: #93c5fd; }

        .chat-send-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s, transform 0.1s;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.02em;
        }

        .chat-send-btn:hover { opacity: 0.9; }
        .chat-send-btn:active { transform: scale(0.97); }

        /* Pagination */
        .sidebar-footer {
            padding: 12px 16px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-footer span {
            font-size: 11px;
            color: rgba(255,255,255,0.45);
        }

        @media (max-width: 768px) {
            .chat-sidebar { width: 100%; height: 200px; }
        }
    </style>

    {{-- Sidebar --}}
    <div class="chat-sidebar">
        <div class="chat-sidebar-header">
            <div class="chat-sidebar-title">Rekan Kerja</div>
            <input type="text" class="chat-search" placeholder="Cari nama...">
        </div>

        <div class="chat-user-list">
            @foreach($users as $user)
                <div wire:click="selectUser('{{ $user->name }}')"
                     class="user-item {{ $selectedUser === $user->name ? 'active' : '' }}">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="user-info-name">{{ $user->name }}</div>
                    <div class="online-dot"></div>
                </div>
            @endforeach
        </div>

        <div class="sidebar-footer">
            <span>Page 1 of 1</span>
            <span>[1]</span>
        </div>
    </div>

    {{-- Main Chat --}}
    <div class="chat-main">
        {{-- Topbar --}}
        <div class="chat-topbar">
            @if($selectedUser)
                <div class="chat-topbar-avatar">
                    {{ strtoupper(substr($selectedUser, 0, 1)) }}
                </div>
                <div>
                    <div class="chat-topbar-name">{{ $selectedUser }}</div>
                    <div class="chat-topbar-status">● Online</div>
                </div>
            @else
                <svg style="width:22px;height:22px;color:#3b82f6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <div class="chat-topbar-empty">Chat Room</div>
            @endif
        </div>

        {{-- Messages --}}
        <div class="chat-messages">
            @if(!$selectedUser)
                <div class="chat-empty">
                    <div class="chat-empty-icon">
                        <svg style="width:28px;height:28px;color:#93c5fd" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3>Selamat Datang!</h3>
                    <p>Pilih rekan kerja untuk memulai percakapan</p>
                </div>
            @else
                @foreach($chats as $chat)
                    <div class="msg-row {{ $chat->sender_username == auth()->user()->name ? 'mine' : 'theirs' }}">
                        <div class="msg-bubble">
                            <p style="margin:0">{{ $chat->message }}</p>
                            <span class="msg-time">{{ $chat->sent_at->format('H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Input --}}
        <div class="chat-input-area">
            <form wire:submit.prevent="sendMessage">
                <div class="chat-input-row">
                    <input wire:model="message"
                           type="text"
                           class="chat-input"
                           placeholder="Tulis pesan...">
                    <button type="submit" class="chat-send-btn">
                        <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>