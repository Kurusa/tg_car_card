<?php

namespace App\Commands\MainMenu;

use App\Commands\BaseCommand;
use App\Models\Card;

class CarNumber extends BaseCommand
{

    function processCommand()
    {
        $card = Card::where('card_id', $this->user->card_id)->where('user_phone', $this->user->phone_number)->first();
        $this->getBot()->sendMessage($this->user->chat_id, $card->car_number);
    }

}