<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {

        $hobbies = Hobby::all();
        return view('hobby.index')->with('hobbies', $hobbies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): View
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'beschreibung' => 'required|min:5',
            ]
        );
        $hobby = new Hobby(
            $request->all()
        );
        $hobby->save();

        //return redirect('hobby');

        return $this->index()->with([
            'msg_success' => 'Das Hobby ' . $hobby->name . ' wurde angelegt!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby): View
    {
        return view('hobby.show')->with('hobby', $hobby);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby): View
    {
        return view('hobby.edit')->with('hobby', $hobby);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby): View
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'beschreibung' => 'required|min:5',
            ]
        );
        $hobby->update(
            $request->all()
        );

        return $this->index()->with([
            'msg_success' => 'Das Hobby ' . $request->name . ' wurde aktualisiert!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby): View
    {
        $hobby->delete();
        $hobbyName = $hobby->name;

        return $this->index()->with([
            'msg_success' => 'Das Hobby ' . $hobbyName . ' wurde gelöscht!'
        ]);
;    }
}
