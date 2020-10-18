<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::all();
        return view('tag.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return View
     */
    public function store(Request $request): View
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'style' => 'required',
            ]
        );
        $tag = new Tag(
            $request->all()
        );
        $tag->save();

        return $this->index()->with([
            'msg_success' => 'Das Tag ' . $tag->name . ' wurde angelegt!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Tag  $tag
     * @return View
     */
    public function show(Tag $tag): View
    {
        return view('tag.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tag  $tag
     * @return View
     */
    public function edit(Tag $tag): View
    {
        return view('tag.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Tag  $tag
     * @return View
     */
    public function update(Request $request, Tag $tag): View
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'style' => 'required',
            ]
        );
        $tag->update(
            $request->all()
        );

        return $this->index()->with([
            'msg_success' => 'Das Tag ' . $request->name . ' wurde aktualisiert!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return View
     * @throws \Exception
     */
    public function destroy(Tag $tag): View
    {
        $tag->delete();
        $tagName = $tag->name;

        return $this->index()->with([
            'msg_success' => 'Das Tag ' . $tagName . ' wurde gelöscht!'
        ]);
    }
}
