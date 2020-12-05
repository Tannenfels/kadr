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

class AdminController extends Controller
{
    /**
     * @const array
     * IDs of roles_users entities eligible for accessing admin panel
     */
    public const ADMIN_ACCESS = [1];

    /**
     * @return Factory|View
     */
    public function dashboard(){
        $articles = Article::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.dashboard', compact('articles'));
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
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

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
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $article = Article::findOrFail($id);

        return view('article.edit',compact('article'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */

    public function updateArticle(Request $request, int $id)
    {
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect()->route('admin.dashboard')
            ->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     *
     */

    public function destroyArticle(int $id)
    {
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.dashboard')
            ->with('success','Article deleted successfully');
    }

    /**
     * @return Factory|View
     */
    public function usersDashboard(){
        if (!Auth::check()) {
            throw new UnauthorizedException();
        }

        $users = User::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.usersDashboard', compact('users'));
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function editUser(int $id){
        $user = User::findOrFail($id);

        return view('editUser', compact('user'));
    }
}
