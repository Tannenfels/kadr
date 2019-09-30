<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\User;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function dashboard(Request $request){
        $news = News::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.dashboard', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);

        $title = htmlspecialchars((string)$request->only('title'));
        $description = htmlspecialchars((string)$request->only('description'));
        $text = htmlspecialchars((string)$request->only('text'));
        $author = Auth::user()->name;

        DB::table('news')->insert(
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
     * @return Response
     */

    public function create()
    {
        return view('news.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return Response
     */

    public function editNews(News $news)
    {
        return view('news.edit',compact('news'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param News $news
     * @return Response
     */

    public function updateNews(Request $request, News $news)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $news->update($request->all());

        return redirect()->route('admin.dashboard')
            ->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return Response
     *
     * @throws \Throwable
     */

    public function destroyNews(News $news)
    {
        $news->delete();

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
