<?php

namespace App\Service;

use App\Models\Subscriber;
use App\Models\Website;

class SubscriberService{


    public function createIfNotExist(string $email):Subscriber
    {
        $email = strtolower($email);
        $subscriber = Subscriber::where('email', $email)->first();
        if(!$subscriber) $subscriber = Subscriber::create(['email' => $email]);

        return $subscriber;
    }

 
}