<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;

class Start extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::NEW) {
            $this->triggerCommand(PreMainMenu::class);
        } elseif ($this->user->status === UserStatusService::DONE) {
            $this->triggerCommand(MainMenu::class);
        }
    }

}

