<?php

namespace App\Console\Commands;

use App\Mail\PostNotificationMailer;
use App\Models\SubscriberPost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class QueuePostToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will queue all pending posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriber_posts = SubscriberPost::with('post', 'subscriber')->where([
            ['has_queued', false]
        ])->get();

        foreach ($subscriber_posts as $subscriber_post) {
            $mailable = new PostNotificationMailer($subscriber_post->subscriber->email, $subscriber_post->post->title, $subscriber_post->post->description);

            // Send will also queue as we implemented should queue in mailable
            Mail::to($subscriber_post->subscriber->email)->send($mailable);
            $subscriber_post->has_queued = true;
            $subscriber_post->save();
        }

        $count = $subscriber_posts->count();

        $this->info("$count Mails queued");
    }
}
