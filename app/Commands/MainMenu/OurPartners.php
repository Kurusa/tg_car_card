<?php

namespace App\Commands\MainMenu;

use App\Commands\BaseCommand;
use App\Models\Card;

class OurPartners extends BaseCommand
{

    function processCommand()
    {
        $this->getBot()->sendMessage($this->user->chat_id, $this->text['our_partners_text']);
    }

}