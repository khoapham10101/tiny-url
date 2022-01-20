<?php

namespace App\Http\Controllers\User;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\UrlPingJob;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    /**
     * Redirect a link if it exists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $path = $request->path();
        if (Helpers::LENGTH == strlen($path)) {
            $url = Cache::rememberForever($path, function () use ($path) {
                return Url::findOneByPath($path)->long_url;
            });
            if ($url) {
                UrlPingJob::dispatch([
                    'function' => 'updateHit',
                    'short_url' => $path
                ]);

                return redirect($url, 301);
            }
        }
        return response(null, 404);
    }
}
