<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class HobbyTagController extends Controller
{
    public function getFilteredHobbies(int $tagId)
    {
        dd($tag->id);
    }
}
