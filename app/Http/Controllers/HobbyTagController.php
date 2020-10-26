<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class HobbyTagController extends Controller
{
    public function getFilteredHobbies(int $tagId)
    {
        $filteredHobbies = Tag::findOrFail($tagId)
                              ->filteredHobbies()
                              ->paginate(10);

        return view('hobby.filteredByTag')->with([
            'hobbies' => $filteredHobbies
        ]);
    }
}
