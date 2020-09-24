<?php

namespace App\Commands;

use App\Models\Card;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class MainMenu extends BaseCommand
{

    function processCommand()
    {
        $this->user->status = UserStatusService::DONE;
        $this->user->save();

        $card = Card::where('card_id', $this->user->card_id)->where('user_phone', $this->user->phone_number)->first();
        if ($card->category == 'Любі друзі') {
            $buttons = [
                [
                    $this->text['manager_phone_button'], $this->text['transport_phone_button']
                ],
                [
                    $this->text['hot_line_phone_button'], $this->text['map_button']
                ],
                [
                    $this->text['our_partners_button'], $this->text['questions_button']
                ],
                [
                    $this->text['car_number_button']
                ]
            ];
        } else {
            $buttons = [
                [
                    $this->text['friends_manager_phone_button'], $this->text['hot_line_phone_button']
                ],
                [
                    $this->text['map_button'], $this->text['questions_button']
                ],
                [
                    $this->text['car_number_button']
                ]
            ];
        }

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