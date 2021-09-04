<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscribtionRequest;
use App\Service\SubscriberService;
use App\Service\SubscriptionService;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    public $subscription_service;
    public $subscriber_service;

    public function __construct(
        SubscriptionService $subscription_service,
        SubscriberService $subscriber_service
    ) {
        $this->subscriber_service = $subscriber_service;
        $this->subscription_service = $subscription_service;
    }

    public function subscribe(CreateSubscribtionRequest $request)
    {
        $validated = (object) $request->validated();
        DB::beginTransaction();

        $subscriber = $this->subscriber_service->createIfNotExist($validated->email);

        $this->subscription_service->subscribeIfNotSubscribed($subscriber, $validated->website_ids);

        DB::commit();

        return $this->json(['message' => 'Subscribed']);
    }
}
