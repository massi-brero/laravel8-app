<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Tag;
use App\Traits\ImageProcessor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class HobbyController extends MyHobbiesBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(10);
        return view('hobby.index')->with([
            'hobbies' => $hobbies,
            'meldg_success' => Session::get('meldg_success')
        ]);
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'beschreibung' => 'required|min:5',
                'user_id' => 'exists:user,id',
                'bild' => 'mimes:jpg,jpeg,png,bmp,gif'
            ]
        );

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $hobby = new Hobby(
            $data
        );
        $hobby->save();

        $this->saveImages($request, $hobby->id);

        return redirect('/hobby/' . $hobby->id)->with('meldg_hinweis', 'Bitte weise ein paar Tags zu ');

    }

    /**
     * @param Hobby $hobby
     * @return View
     */
    public function show(Hobby $hobby): View
    {
        $allTags = Tag::all();

        return view('hobby.show')->with([
            'hobby' => $hobby,
            'meldg_success' => Session::get('meldg_success'),
            'meldg_hinweis' => Session::get('meldg_hinweis'),
            'verfuegbareTags' => $allTags->diff($hobby->tags)
        ]);
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
                'bild' => 'mimes:jpg,jpeg,png,bmp,gif'
            ]
        );

        $this->saveImages($request, $hobby->id);

        $hobby->update(
            $request->all()
        );

        return $this->index()->with([
            'meldg_success' => 'Das Hobby ' . $request->name . ' wurde aktualisiert!'
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
    public function destroy(Hobby $hobby): RedirectResponse
    {
        $hobbyName = $hobby->name;
        $hobby->delete();

        return back()->with([
            'meldg_success' => 'Das Hobby ' . $hobbyName . ' wurde gelöscht!'
        ]);
    }


}
