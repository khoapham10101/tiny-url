<?php

namespace App\Http\Controllers\User;

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
//        dd($request->user()->roles());
//        $roles = $request->user()->roles();
//        dd($roles);
//        foreach($roles as $role) {
//            print_r($role);
//        }
//        dd(1);
        $user_id = $request->user()->id;
        $urls = Url::where('user_id', $user_id)->paginate(10);
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
                'short_url' => 'XzdVA85',
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url = Url::find($id);
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
        $url = Url::findOrFail($id);
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
        Url::destroy($id);
        $request->session()->flash('success', 'You have deleted the url.');
        return redirect(route('user.urls.index'));
    }
}
