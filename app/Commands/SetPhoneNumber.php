<?php

namespace App\Commands;

use App\Commands\BaseCommand;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class SetPhoneNumber extends BaseCommand
{

    function processCommand($par = false)
    {
        if ($this->user->status == UserStatusService::PHONE_NUMBER) {
            if ($this->update->getMessage()->getContact()) {
                $this->user->phone_number = str_replace('+', '', $this->update->getMessage()->getContact()->getPhoneNumber());
                $this->user->save();

                $this->user->phone_number = str_replace('38', '', $this->user->phone_number);
                $this->user->save();

                $this->triggerCommand(SetCardId::class);
            }
        } else {
            $this->user->status = UserStatusService::PHONE_NUMBER;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['ask_phone'], new ReplyKeyboardMarkup([
                [['text' => $this->text['click'], 'request_contact' => true]],
            ], false, true));
        }
    }

}