<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ArticleRequest;
use App\Article;
use App\Author;
use App\Http\Requests;
use Response;
use DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::select('articles.id', 'articles.title', 'authors.name as author', 'articles.content as summary', 'articles.url', DB::raw('DATE(articles.created_at) as createdAt'))
                            ->leftJoin('authors', 'articles.author_id', '=', 'authors.id')
                            ->get();
        return Response::json($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $author = Author::find($request->author_id);
        if($author){
            $article = Article::create([
                'author_id' => $author->id,
                'title'     => $request->title,
                'url'       => $request->url,
                'content'   => $request->content
            ]);
            if($article){
                return 'Article Created!';
            }else{
                return Response::json('Internal Server Error.',500);
            }
        }else{
            return Response::json('Author Not Found. Invalid author_id.',400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::select('articles.id', 'articles.title', 'authors.name as author', 'articles.content', 'articles.url', DB::raw('DATE(articles.created_at) as createdAt'))
                            ->leftJoin('authors', 'articles.author_id', '=', 'authors.id')
                            ->where('articles.id', '=', $id)
                            ->first();
        if($article){
            return Response::json($article);
        }else{
            return Response::json('Data Not Found.',404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $author = Author::find($request->author_id);
        if($author){
            $old_url = Article::where('url', '=', $request->url)
                                ->where('id', '!=', $id)
                                ->get();
            if(count($old_url)>0){
                return Response::json('Conflicts. URL already established.',409);
            }

            $article = Article::find($id);
            $article->author_id = $request->author_id;
            $article->title     = $request->title;
            $article->url       = $request->url;
            $article->content   = $request->content;
            $article->save();

            return 'Article Updated!';
        }else{            
            return Response::json('Author Not Found. Invalid author_id.',400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if($article){
            $article->delete();
            return 'Article Deleted!';
        }else{
            return Response::json('Author Not Found. Invalid author_id.',400);
        }
    }
}
