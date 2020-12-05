<?php

namespace App\Http\Controllers;

use App\Article;
use App\Classes\CommonConstants;
use App\Classes\CustomBBCodeApplier;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;
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

        $article->text = CustomBBCodeApplier::apply($article->text);

        return view('article.show',compact('article'));
    }

    /**
     * Display the specified resource.
     *
     * DO NOT TOUCH!
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
     * DO NOT TOUCH!
     * @param Request $request
     * @return RedirectResponse
     */

    public function legacyUnpluginedShow(Request $request)
    {
        $id = $request->all()['id'];
        return redirect()->route('show', ['id' => $id]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeCommentThread(Request $request){
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $request->validate([
            'text' => 'required',
            'article_id' => 'required'
        ]);

        $text = htmlspecialchars((string)$request->only('text')['text']);
        $articleId = htmlspecialchars((int)$request->only('article_id')['article_id']);
        $author = Auth::user()->id;

        DB::table('comment_threads')->insert(
            array(
                'text' => $text,
                'user_id' => $author,
                'article_id' => $articleId,
                'created_at' => Carbon::now(CommonConstants::TIMEZONE_TEXT)->toDateTimeString(),
                'author_ip' => $request->ip()
            )
        );

        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeComment(Request $request){

        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $request->validate([
            'text' => 'required',
            'thread_id' => 'required'
        ]);
        $text = htmlspecialchars((string)$request->only('text')['text']);
        $threadId = htmlspecialchars((int)$request->only('thread_id')['thread_id']);
        $author = Auth::user()->id;

        DB::table('comments')->insert(
            array(
                'text' => $text,
                'user_id' => $author,
                'thread_id' => $threadId,
                'created_at' => Carbon::now(CommonConstants::TIMEZONE_TEXT)->toDateTimeString(),
                'author_ip' => $request->ip()
            )
        );

        return back();
    }

    public function editComment(Request $request){

        if (!Auth::check()) {
            throw new UnauthorizedException();
        }
        $request->validate([
            'text' => 'required',
            'comment_id' => 'required'
        ]);
    }

    public function deleteComment(int $commentId){

    }
}
