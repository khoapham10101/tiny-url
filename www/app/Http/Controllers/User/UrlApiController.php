<?php

namespace App\Http\Controllers\User;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use App\Http\Resources\UrlsResource;
use Illuminate\Support\Facades\Cache;

class UrlApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UrlsResource::collection(
            Url::where('user_id', $request->user()->id)->paginate(10)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $short_url = Helpers::generate(Helpers::LENGTH);
        $url = Url::create(
            [
                'short_url' => $short_url,
                'long_url' => $request->long_url,
                'hits' => 0,
                'user_id' => $request->user()->id
            ]
        );
        Helpers::rememberForever($short_url);
        return new UrlsResource($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        return new UrlsResource(Url::findOneByUser($id, $request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $url = Url::findOneByUser($id, $request);
        $url->update([
           'long_url' => $request->long_url
        ]);
        Helpers::rememberForever($url->short_url);
        return new UrlsResource($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $url = Url::findOneByUser($id, $request);
        if ($url !== null) {
            Url::destroy($id);
            Helpers::clearCacheForKey($url->short_url);
            return response(null, 204);
        }
        return response(null, 404);
    }
}
