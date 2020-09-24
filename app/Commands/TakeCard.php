<?php

namespace App\Commands;

use App\Commands\BaseCommand;
use App\Models\Card;

class TakeCard extends BaseCommand
{

    function processCommand()
    {
        $this->getBot()->sendMessage($this->user->chat_id, $this->text['receive_card_text']);
    }

}