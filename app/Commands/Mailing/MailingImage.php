<?php

namespace App\Commands\Mailing;

use App\Commands\BaseCommand;
use App\Commands\MainMenu;
use App\Models\Mailing;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class MailingImage extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status == UserStatusService::MAILING_IMAGE) {
            if ($this->update->getMessage()->getText() == $this->text['cancel']) {
                $this->triggerCommand(MainMenu::class);
            } elseif ($this->update->getMessage()->getText() == $this->text['skip']) {
                $this->triggerCommand(WhomToSend::class);
            } else {
                Mailing::where('user_id', $this->user->id)->update([
                    'image' => $this->update->getMessage()->getPhoto()[0]->getFileId()
                ]);
                $this->triggerCommand(WhomToSend::class);
            }
        } else {
            $this->user->status = UserStatusService::MAILING_IMAGE;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['add_mailing_image'], new ReplyKeyboardMarkup([
                [$this->text['skip'], $this->text['cancel']],
            ], false, true));
        }
    }

}