<?php

namespace App\Commands;

use App\Models\Card;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class SetCardId extends BaseCommand
{

    function processCommand($par = false)
    {
        if ($this->user->status == UserStatusService::CARD_ID) {
            if ($this->update->getMessage()->getText() == $this->text['back']) {
                $this->triggerCommand(SetPhoneNumber::class);
            } else {
                $this->user->card_id = $this->update->getMessage()->getText();
                $this->user->save();

                $card = Card::where('card_id', $this->user->card_id)->where('user_phone', $this->user->phone_number)->get();
                if ($card->count()) {
                    $this->triggerCommand(MainMenu::class);
                } else {
                    $this->getBot()->sendMessage($this->user->chat_id, $this->text['cant_find']);
                }
            }
        } else {
            $buttons = [
                [
                    $this->text['back']
                ],
            ];
            $this->user->status = UserStatusService::CARD_ID;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['ask_card_id'], new ReplyKeyboardMarkup($buttons, false, true));
        }
    }

}