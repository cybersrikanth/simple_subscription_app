<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class PostNotificationMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $title;
    public $description;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email, string $title, string $description)
    {
        $this->email = $email;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = Config::get('mail.mailers.'.Config::get('mail.default').'.username')??'';

        return $this->from($from, Config::get('app.name'))
        ->subject(Str::limit($this->title, 25))->view('mail.PostSubscription');
    }
}
