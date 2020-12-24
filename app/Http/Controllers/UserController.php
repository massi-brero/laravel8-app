<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends MyHobbiesBaseController
{

    public function __construct()
    {
        $this->middleware('auth')
             ->except([
                 'show'
             ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $completeUser = User::find($user->id);
        return view('user.show')->with('user', $completeUser);
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        if(auth()->guest()) {
            abort(403);
        }

        abort_unless(Gate::allows('update', $user), 403);

        $completeUser = User::find($user->id);
        return view('user.edit')->with('user', $completeUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        abort_unless(Gate::allows('update', $user), 403);
        $request->validate(
            [
                'motto' => 'required|min:5',
                'bild' => 'mimes:jpg,jpeg,png,bmp,gif'
            ]
        );

        $this->saveImages($request, $user->id, 'user');

        $user->update(
            $request->all()
        );

        return redirect('/home');
    }

    /**
     * @param User $user
     */
    public function destroy(User $user)
    {
        //
    }
}
