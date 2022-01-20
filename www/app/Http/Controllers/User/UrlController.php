<?php

namespace App\Http\Controllers\User;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $urls = Url::sortable()->where('user_id', $user_id)->paginate(10);

        return view('user.urls.index')->with(
            [
                'urls' => $urls
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.urls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'long_url' => 'required'

        ]);
        $url = Url::create(
            [
                'short_url' => Helpers::generate(Helpers::LENGTH),
                'long_url' => $request->long_url,
                'hits' => 0,
                'user_id' => $request->user()->id
            ]
        );
        $request->session()->flash('success', 'You have created new url.');
        return redirect(route('user.urls.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $url = Url::findOneByUser($id, $request);
        return view('user.urls.show', ['url' => $url]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $url = Url::findOneByUser($id, $request);
        return view('user.urls.update', ['url' => $url]);
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
        $this->validate($request,[
            'long_url' => 'required',
        ]);
        $url = Url::findOneByUser($id, $request);
        $url->update($request->all());

        return redirect(route('user.urls.index'));
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
            $request->session()->flash('success', 'You have deleted the url.');
        }
        else {
            $request->session()->flash('success', 'You do nothing.');
        }
        return redirect(route('user.urls.index'));
    }
}
