<?php

namespace App\Http\Controllers;

//use App\Models\Hobby;
use App\Models\Hobby;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;

class HobbyTagController extends Controller
{
    public function getFilteredHobbies(int $tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $filteredHobbies = $tag->filteredHobbies()
                               ->paginate(10);

        return view('hobby.filteredByTag', [
            'hobbies' => $filteredHobbies,
            'tag' => $tag
        ]);
    }

    public function attachTag(int $hobbyId, int $tagId)
    {
        $hobby = Hobby::find($hobbyId);

        if (Gate::denies('connect_hobby_tag', $hobby)) {
            abort(403, 'Das Hobby gehört dir nicht');
        }

        $hobby->tags()->attach($tagId);
        $tag = Tag::find($tagId);

        return back()->with('msg_success', "Das Tag <strong>$tag->name</strong>  wurde hinzugefügt.");
    }

    public function detachTag(int $hobbyId, int $tagId)
    {
        $hobby = Hobby::find($hobbyId);

        if (Gate::denies('connect_hobby_tag', $hobby)) {

        }

        $hobby->tags()->detach($tagId);
        $tag = Tag::find($tagId);

        return back()->with('msg_success', "Das Tag <strong>$tag->name</strong> wurde entfernt.");

    }
}
