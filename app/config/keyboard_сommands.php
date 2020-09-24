<?php
return [
    'manager_phone_button' => \App\Commands\MainMenu\ManagerPhone::class,
    'friends_manager_phone_button' => \App\Commands\MainMenu\ManagerPhone::class,
    'transport_phone_button' => \App\Commands\MainMenu\TransportPhone::class,
    'hot_line_phone_button' => \App\Commands\MainMenu\HotLinePhone::class,
    'map_button' => \App\Commands\MainMenu\Map::class,
    'our_partners_button' => \App\Commands\MainMenu\OurPartners::class,
    'questions_button' => \App\Commands\MainMenu\Question::class,
    'car_number_button' => \App\Commands\MainMenu\CarNumber::class,
    'create_mailing_button' => \App\Commands\Mailing\MailingText::class,
    'i_have_card' => \App\Commands\SetPhoneNumber::class,
    'receive_card' => \App\Commands\TakeCard::class,
];