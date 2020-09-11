<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\View\View;
use App\User;
use Throwable;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function dashboard(Request $request){
        $news = Article::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.dashboard', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function storeArticle(Request $request)
    {
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $title = htmlspecialchars((string)$request->only('title'));
        $description = htmlspecialchars((string)$request->only('description'));
        $text = htmlspecialchars((string)$request->only('text'));
        $author = Auth::user()->name;

        DB::table('articles')->insert(
            array(
                'title' => $title,
                'description' => $description,
                'text' => $text,
                'author' => $author
            )
        );

        return redirect()->route('admin.dashboard')
            ->with('success','Article created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */

    public function createArticle()
    {
        return view('article.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     */

    public function editArticle(int $id)
    {
        $article = Article::find($id);

        return view('article.edit',compact('article'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param Article $article
     * @return RedirectResponse
     */

    public function updateArticle(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $article->update($request->all());

        return redirect()->route('admin.dashboard')
            ->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     *
     * @throws Throwable
     */

    public function destroyArticle(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.dashboard')
            ->with('success','Article deleted successfully');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function usersDashboard(Request $request){
        $users = User::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.usersDashboard', compact('users'));
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function editUser(User $user){
        $id = $user->id;

        return view('editUser', compact('id'));
    }
}
