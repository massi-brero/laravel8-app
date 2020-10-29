<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

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
}
