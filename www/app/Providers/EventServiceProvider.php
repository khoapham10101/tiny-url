<?php

namespace App\Providers;

use App\Events\PodcastProcessed;
use App\Jobs\UrlPingJob;
use App\Listeners\SendPodcastNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            UrlPingJob::class.'@handle',
            fn($job)=>$job->handle()
        );
        Event::listen(
            PodcastProcessed::class,
            [SendPodcastNotification::class, 'handle']
        );

//        Event::listen(queueable(function (PodcastProcessed $event) {
//            //
//        }));
        Event::listen(function (PodcastProcessed $event) {
        });
    }
}
