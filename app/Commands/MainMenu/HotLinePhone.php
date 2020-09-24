<?php

namespace App\Commands\MainMenu;

use App\Commands\BaseCommand;
use App\Models\Card;

class HotLinePhone extends BaseCommand
{

    function processCommand()
    {
        $this->getBot()->sendMessage($this->user->chat_id, $this->text['hot_line_phone_text']);
    }

}