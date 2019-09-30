<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Genert\BBCode\BBCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function list(){
        $news = Article::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
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
        $article = Article::findOrFail($id);

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

    public function storeComment(Request $request){
        $request->validate([
            'text' => 'required',
            'article_id' => 'required'
        ]);
        $text = htmlspecialchars((string)$request->only('text'));
        $articleId = htmlspecialchars((int)$request->only('article_id'));
        $author = Auth::user()->name;

        DB::table('news')->insert(
            array(
                'text' => $text,
                'author' => $author,
                'article_id' => $articleId
            )
        );

        return back();
    }

    public function editComment(Request $request){
        $request->validate([
            'text' => 'required',
            'comment_id' => 'required'
        ]);
    }

    public function deleteComment(){

    }
}
