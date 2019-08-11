<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function list(){
        $news = News::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
        return view('news.list', compact('news'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function create()
    {
        return view('articles.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    public function show(int $id)
    {
        $article = News::findOrFail($id);

        return view('news.show',compact('article'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    public function legacyShow(int $id)
    {
        return redirect()->route('show', ['id' => $id]);
    }
}
