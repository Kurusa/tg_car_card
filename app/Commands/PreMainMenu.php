<?php

namespace App\Commands;

use App\Models\Card;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class PreMainMenu extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [
                $this->text['i_have_card'], $this->text['receive_card']
            ],
        ];

        $admin_list = explode(',', env('ADMIN_LIST'));
        foreach ($admin_list as $admin) {
            if ($this->user->chat_id == $admin) {
                $buttons[] = [
                    $this->text['create_mailing_button']
                ];
            }
        }

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['main_menu'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}