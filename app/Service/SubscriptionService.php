<?php

namespace App\Service;

use App\Models\Subscriber;
use App\Models\Website;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SubscriptionService{


    public function subscribeIfNotSubscribed(Subscriber $subscriber, array $website_ids)
    {
        $avail_website_ids = Website::whereIn('id',array_unique($website_ids))->get()->pluck('id')->toArray();
        $not_exists = array_diff($website_ids, $avail_website_ids);

        if(!empty($not_exists)) throw new HttpException(422, 'Given website Id\'s "'. implode(',', $not_exists) . '" doesnt exists');
        $subscriber->websites()->syncWithoutDetaching($website_ids);
        return true;
    }

}