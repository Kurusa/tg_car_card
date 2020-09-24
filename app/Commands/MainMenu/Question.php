<?php

namespace App\Commands\MainMenu;

use App\Commands\BaseCommand;
use App\Models\Card;

class Question extends BaseCommand
{

    function processCommand()
    {
        $this->getBot()->sendMessage($this->user->chat_id, $this->text['questions_text']);
    }

}