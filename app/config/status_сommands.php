<?php

use App\Services\Status\UserStatusService;

return [
    UserStatusService::PHONE_NUMBER => \App\Commands\SetPhoneNumber::class,
    UserStatusService::CARD_ID => \App\Commands\SetCardId::class,
    UserStatusService::MAILING_TEXT => \App\Commands\Mailing\MailingText::class,
    UserStatusService::MAILING_IMAGE => \App\Commands\Mailing\MailingImage::class,
    UserStatusService::WHOM_TO_SEND => \App\Commands\Mailing\WhomToSend::class,
];