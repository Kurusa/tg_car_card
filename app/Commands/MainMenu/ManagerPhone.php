<?php

namespace App\Commands\MainMenu;

use App\Commands\BaseCommand;
use App\Models\Card;

class ManagerPhone extends BaseCommand
{

    function processCommand()
    {
        $card = Card::where('card_id', $this->user->card_id)->where('user_phone', $this->user->phone_number)->first();
        $this->getBot()->sendMessage($this->user->chat_id, $card->manager_name . ': ' . $card->manager_phone);
    }

}