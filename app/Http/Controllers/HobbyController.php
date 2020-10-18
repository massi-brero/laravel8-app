<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {

        $hobbies = Hobby::all();
        return view('hobby.index')->with('hobbies', $hobbies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
     * @param Hobby $hobby
     * @return View
     */
    public function show(Hobby $hobby): View
    {
        return view('hobby.show')->with('hobby', $hobby);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hobby $hobby
     * @return View
     */
    public function edit(Hobby $hobby): View
    {
        return view('hobby.edit')->with('hobby', $hobby);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hobby $hobby
     * @return View
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
     * @param Hobby $hobby
     * @return View
     * @throws \Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
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
