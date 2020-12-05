<?php

namespace App\Http\Controllers;

use App\Classes\CustomBBCodeApplier;
use App\ForumCategory;
use App\ForumPost;
use App\ForumThread;
use Genert\BBCode\BBCode;

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

    public function showThread(int $id)
    {
        $post = ForumThread::query()->findOrFail($id);

        $post->text = CustomBBCodeApplier::apply($post->text);

        return view('forum.showPost', compact('post'));
    }
}
