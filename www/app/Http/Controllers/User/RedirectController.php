<?php

namespace App\Http\Controllers\User;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\Request;

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
        if(Helpers::LENGTH == strlen($path)) {
            $url = Url::findOneByPath($path);
            if ($url) {
                return redirect($url->long_url, 301);
            }
            return response(null, 404);
        }
    }
}
