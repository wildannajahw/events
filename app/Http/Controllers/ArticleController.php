<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        $articles = \App\Article::with('categories')->where("name", "LIKE", "%$keyword%")->paginate(10);


        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_article = new \App\Article;
        $new_article->name = $request->get('name');
        $new_article->description = $request->get('description');
        $new_article->date = $request->get('date');
        $new_article->created_by = \Auth::user()->id;

        $cover = $request->file('cover');

        if($cover){
          $cover_path = $cover->store('article-covers', 'public');

          $new_article->cover = $cover_path;
        }

        $new_article->save();
        $new_article->categories()->attach($request->get('categories'));
        return redirect()
        ->route('articles.create')->with('status', 'article successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = \Crypt::decrypt($id);
        $article = \App\Article::findOrFail($id);
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = \Crypt::decrypt($id);
        $article = \App\Article::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = \Crypt::decrypt($id);
        $article = \App\Article::findOrFail($id);
        $article->name = $request->get('name');
        $article->description = $request->get('description');
        $article->date = $request->get('date');
        $new_cover = $request->file('cover');
        if($new_cover){
            if($article->cover && file_exists(storage_path('app/public/' . $article->cover))){
                \Storage::delete('public/'. $article->cover);
            }
            $new_cover_path = $new_cover->store('article-covers', 'public');
            $article->cover = $new_cover_path;
        }
        $article->updated_by = \Auth::user()->id;
        $article->save();
        $article->categories()->sync($request->get('categories'));
        return redirect()->route('articles.edit', ['id'=>$article->id])->with('status', 'article successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = \App\Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('status', 'article moved to trash');
    }
    public function trash(){
        $articles = \App\Article::onlyTrashed()->paginate(10);
        return view('articles.trash', ['articles' => $articles]);
    }
    public function restore($id){
        $article = \App\Article::withTrashed()->findOrFail($id);

        if($article->trashed()){
            $article->restore();
            return redirect()->route('articles.trash')->with('status', 'article successfully restored');
        } else {
            return redirect()->route('articles.trash')->with('status', 'article is not in trash');
        }
    }
    public function deletePermanent($id){
        $article = \App\Article::withTrashed()->findOrFail($id);

        if(!$article->trashed()){
          return redirect()->route('articles.trash')->with('status', 'article is not in trash!')->with('status_type', 'alert');
        } else {
          $article->categories()->detach();
          $article->orders()->detach();
          $article->forceDelete();

          return redirect()->route('articles.trash')->with('status', 'article permanently deleted!');
        }
    }
}
