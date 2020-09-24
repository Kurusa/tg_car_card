<?php

namespace App\Commands\Mailing;

use App\Commands\BaseCommand;
use App\Commands\MainMenu;
use App\Models\Mailing;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class MailingText extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status == UserStatusService::MAILING_TEXT) {
            if ($this->update->getMessage()->getText() == $this->text['cancel']) {
                $this->triggerCommand(MainMenu::class);
            } else {
                Mailing::create([
                    'user_id' => $this->user->id,
                    'text' => $this->update->getMessage()->getText()
                ]);
                $this->triggerCommand(MailingImage::class);
            }
        } else {
            $this->user->status = UserStatusService::MAILING_TEXT;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['write_mailing_text'], new ReplyKeyboardMarkup([
                [$this->text['cancel']],
            ], false, true));
        }
    }

}