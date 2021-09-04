<?php

namespace App\Console\Commands;

use App\Mail\NotificationMailer;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notice:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to all subscribers';

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
        $subject = $this->ask('Please enter subject.');
        $content = $this->ask('Please enter content.');

        Subscriber::all()->each(function($subscriber) use($subject, $content){
            $mailable = new NotificationMailer($subscriber->email, $subject, $content);
            Mail::to($subscriber->email)->send($mailable);
        });

        $this->info('Mails queued for all subscribers');
    }
}
