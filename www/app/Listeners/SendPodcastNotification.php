<?php

namespace App\Listeners;

use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class SendPodcastNotification
{
    private Request $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PodcastProcessed  $event
     * @return void
     */
    public function handle(PodcastProcessed $event)
    {
        $uid = $this->request->user()->id;
//        dd($u);
        $user = $event->user->getById($uid);
//        dd($event->user->getById($uid)->email);
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('logs/test.log', Logger::WARNING));
        $log->warning("User $user->id: $user->email");
    }
}
