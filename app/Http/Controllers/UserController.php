<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        return view('user.show')->with('user', $user);
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'motto' => 'required|min:5',
                'bild' => 'mimes:jpg,jpeg,png,bmp,gif'
            ]
        );

        $this->processImage(
            $request,
            $this->getImageFormats(
                $this->getBasepath($request, $user->id)
            )
        );

        $user->update(
            $request->all()
        );

        return $this->index()->with([
            'meldg_success' => 'Der Nutzer ' . $request->name . ' wurde aktualisiert!'
        ]);
    }

    /**
     * @param User $user
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * replace with configuration solution
     *
     * @param string $basePath
     * @return \array[][]
     */
    private function getImageFormats(string $basePath): array
    {
        $formats = [
            self::ORIENTATION_LANDSCAPE => [
                [
                    'base_size' => 1200,
                    'path' => $basePath . '_landscape_big.jpg',
                ],
                [
                    'base_size' => 60,
                    'path' => $basePath . '_landscape_thumb.jpg',
                ]
            ],
            self::ORIENTATION_PORTRAIT => [
                [
                    'base_size' => 900,
                    'path' => $basePath . '_portrait_big.jpg',
                ],
                [
                    'base_size' => 60,
                    'path' => $basePath . '_portrait_thumb.jpg',
                ]
            ]
        ];
        return $formats;
    }
}
