<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function list(){
        $news = News::whereRaw(1)->orderBy('id', 'DESC')->paginate(10);

        return view('news.list', compact('news'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()

    {

        return view('products.create');

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show(int $id)
    {
        $article = News::findOrFail($id);

        return view('news.show',compact('article'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */

    public function edit(News $news)

    {

        return view('products.edit',compact('product'));

    }



    /**

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, News $news)

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
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     *
     * @throws \Throwable
     */

    public function destroy(News $news)

    {

        $news->delete();



        return redirect()->route('products.index')

            ->with('success','News deleted successfully');

    }
}
