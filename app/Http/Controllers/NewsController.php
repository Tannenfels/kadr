<?php

namespace App\Http\Controllers;

use App\News;
use Genert\BBCode\BBCode;
use Illuminate\Http\Request;
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    public function show(int $id)
    {
        $article = News::findOrFail($id);

        $bbCode = new BBCode();

        $article->text = $bbCode->convertToHtml($article->text);

        return view('news.show',compact('article'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    public function legacyPluginShow(int $id)
    {
        return redirect()->route('show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */

    public function legacyUnpluginedShow(Request $request)
    {
        $id = $request->all()['id'];
        return redirect()->route('show', ['id' => $id]);
    }
}
