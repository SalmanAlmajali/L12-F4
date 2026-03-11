<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;

class ChatRoom extends Page
{
    // Menggunakan tipe data yang diminta tepat oleh Intelephense
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string | UnitEnum | null $navigationGroup = 'Chat';

    protected static ?string $navigationLabel = 'Chat';

    protected static ?string $title = 'Chat Room';

    // Sesuai diskusi sebelumnya, $view di v4 adalah NON-STATIC
    protected string $view = 'filament.pages.chat-room';
}