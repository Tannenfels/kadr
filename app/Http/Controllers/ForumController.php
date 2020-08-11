<?php

namespace App\Http\Controllers;

use App\ForumCategory;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function list()
    {
        $categories = ForumCategory::all();

        return view('forum.list', compact('categories'));
    }

    public function showCategory(String $category)
    {

    }
}
