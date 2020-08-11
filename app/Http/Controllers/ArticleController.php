<?php

namespace App\Http\Controllers;

use App\Article;
use Genert\BBCode\BBCode;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */


    public function list(){
        $articles = Article::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
        return view('article.list', compact('articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Factory|View
     */

    public function show(int $id)
    {
        $article = Article::findOrFail($id);

        $bbCode = new BBCode();

        $article->text = $bbCode->convertToHtml($article->text);

        return view('article.show',compact('article'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RedirectResponse
     */

    public function legacyPluginShow(int $id)
    {
        return redirect()->route('show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return RedirectResponse
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

        DB::table('comments')->insert(
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
