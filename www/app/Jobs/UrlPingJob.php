<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Url;

class UrlPingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->data['function']) {
            case 'updateHit':
                $this->updateHit($this->data['short_url']);
                break;

            default:
                break;
        }
    }

    /**
     * Anytime users hit their links, hits will be increased.
     *
     * @param $short_url
     * @return void
     */
    private function updateHit($short_url)
    {
        $url = Url::findOneByPath($short_url);
        $hits = $url->hits + 1;
        $url->update([
            'hits' => $hits
        ]);
    }
}
