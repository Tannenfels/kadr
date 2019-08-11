<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    public function storeNews(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        News::create($request->all());

        return redirect()->route('products.index')
            ->with('success','News created successfully.');
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
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return Response
     */

    public function editNews(News $news)
    {
        return view('products.edit',compact('product'));
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

        return redirect()->route('products.index')
            ->with('success','News updated successfully');
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

        return redirect()->route('products.index')
            ->with('success','News deleted successfully');
    }
}
