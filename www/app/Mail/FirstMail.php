<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Mail\Mailer;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Redis\Factory;
class FirstMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Factory $redis)
    {

        $this->redis = $redis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->redis->connection();
//        $this->redis->
        return $this->view('view.name');
    }
}
