<?php

namespace App\Commands\Mailing;

use App\Commands\MainMenu;
use App\Models\User;
use App\ViberHelpers\ViberApi;
use Illuminate\Database\Capsule\Manager as DB;
use App\Commands\BaseCommand;
use App\Models\Mailing;

class StartMailing extends BaseCommand
{

    function processCommand()
    {
        $mailing = Mailing::where('user_id', $this->user->id)->first();
        $viber = new ViberApi();

        $user_list = User::all();
        foreach ($user_list as $user) {
            if ($mailing->image) {
                if ($mailing->whom == 'телеграм') {
                    if ($user->chat_id) {
                        $this->getBot()->sendPhoto($user->chat_id, $mailing->image, $mailing->text ?: '');
                    }
                } else {
                    $viber->sendMessage($mailing->text, $user->viber_chat_id);
                }
            } else {
                if ($mailing->whom == 'телеграм') {
                    if ($user->chat_id) {
                        $this->getBot()->sendMessage($user->chat_id, $mailing->text);
                    }
                } else {
                    $viber->sendMessage($mailing->text, $user->viber_chat_id);
                }
            }

        }

        DB::delete('DELETE FROM mailing');
        $this->triggerCommand(MainMenu::class);
    }

}