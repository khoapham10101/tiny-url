<?php

namespace App\Http\Controllers\Admin;

use App\Events\PodcastProcessed;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $u = $request->getUser();
//        dd($u);
        PodcastProcessed::dispatch($this->users);
//        echo asset('storage/file.txt');
//        $collection = collect([
//            ['account_id' => 'account-x10', 'product' => 'Chair'],
//            ['account_id' => 'account-x10', 'product' => 'Bookcase'],
//            ['account_id' => 'account-x11', 'product' => 'Desk'],
//        ]);
//
//        $grouped = $collection->groupBy('account_id');
//
//        $group = $grouped->all();
//        dd($group);
//        Collection::macro('toUpper', function () {
//            return $this->map(function ($value) {
//                return Str::upper($value);
//            });
//        });
//
//        $collection = collect(['first', 'second']);
//
//        $upper = $collection->toUpper();
//        dd($upper);
//        dd([1, 2, 3]);
//        dd($collection = collect([1, 2, 3]));
        // create a log channel
//        $log = new Logger('name');
//        $log->pushHandler(new StreamHandler('logs/test.log', Logger::WARNING));
//
//        // add records to the log
//        $log->warning('first log');
//        $log->error($collection = collect([1, 2, 3]));
//        $a = $request->session()->invalidate();
//        $a = $request->session();
//        dd($a);
//        $request->session()->get('laravel_session', 'default');
//        $currentPage = request()->get('page',0);
//        $items = 10;
//        $users = Cache::remember('users-' . $currentPage, 10000, function() use ($items, $currentPage) {
//            return User::skip($currentPage * $items)->paginate($items);
//        });
//        $users = User::paginate(10);
        $users = $this->users->paginate(10);
        return view('admin.users.index')->with(
            [
            'users' => $users
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
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->users->create($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);
//        $request->session()->flash('success', 'You have created new user.');
        $request->session()->flash('success', __('user.user_created'));
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);
        $request->session()->flash('success', 'You have deleted the user.');
        return redirect(route('admin.users.index'));
    }
}
