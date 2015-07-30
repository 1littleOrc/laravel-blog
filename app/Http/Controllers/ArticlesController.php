<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->paginate();
        $page_title = 'Блог веб разработчика: php, linux и другое';
        return view('articles.index', compact('articles', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $article = new Article;
        return view('articles.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return redirect(route('post', ['path' => $article->path]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $article = $this->article_by_path($id);
        if ((string)$id == (string)(int)$id && $article->path)
            return redirect(route('post', ['path' => $article->path]), 301);

        $page_title = $article->title;

        return view('articles.show', compact('article', 'page_title'));
    }

    protected function article_by_path($id)
    {
        if ((string)$id == (string)(int)$id)
            return Article::where('id', $id)->firstOrFail();
        else
            return Article::where('path', $id)->firstOrFail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        $article->update($request->all());
        return redirect(route('post', ['path' => $article->path]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Article::where('id', $id)->delete();
        return redirect('/');
    }

    public function store_comment(StoreCommentRequest $request, $id)
    {
        $this->article_by_path($id)->comments()->create([
            'username' => $request->get('username'),
            'body' => $request->get('body'),
        ]);
        return redirect($request->fullUrl());
    }

    public function delete_comment(Request $request)
    {
        return Comment::destroy($request->get('id'));
    }

    public function tag($tag)
    {
        $articles = Article::where('content', 'like', "%$tag%")
            ->orWhere('title', 'like', "%$tag %")->orderBy('id', 'desc')->paginate();
        $page_title = 'Блог веб разработчика: ' . $tag;
        if (!$articles->count())
            abort(404);
        return view('articles.index', compact('articles', 'page_title'));
    }
}
