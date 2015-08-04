<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int $page
     * @return Response
     */
    public function index(Request $request, $page=1)
    {
        // changing pagination page from route param
        Paginator::currentPageResolver(function() use ($page) {return $page;});
        // getting articles
        $articles = Article::orderBy('id', 'desc')->paginate();
        // changing routing in rendered pagination view
        $pagination_view = $articles->render();
        // from "/?page=$page" to "/page/$page"
        $pagination_view = preg_replace('|/(page/\d+/?)?\?page=(\d+)|', '/page/$2', $pagination_view);
        // replace "/page/1" to "/"
        $pagination_view = str_replace('page/1"', '"', $pagination_view);

        //redirect from $_GET paging to new routing
        $_page = $request->get('page');
        if ($_page && (string)abs($_page) === $_page) {
            if ($_page == 1)
                return redirect('/');
            return redirect('/page/' . $_page);
        }

        // page title tag
        $page_title = 'Блог веб разработчика: php, linux и другое';
        // ajax infinite scrolling or full html page
        $view = $request->ajax() ? 'articles.index-content' : 'articles.index';
        return response()
            ->view($view, compact('articles', 'page_title', 'pagination_view', 'page'))
            // forever cookie to identify user in star rating
            ->withCookie($this->rating_cookie($request));
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
    public function show(Request $request, $id)
    {
        $article = $this->article_by_path($id);
        if ((string)$id == (string)(int)$id && $article->path)
            return redirect(route('post', ['path' => $article->path]), 301);

        $page_title = $article->title;

        return response()
            ->view('articles.show', compact('article', 'page_title'))
            // forever cookie to identify user star rating
            ->withCookie($this->rating_cookie($request));
    }

    protected function article_by_path($id)
    {
        if ((string)$id == (string)(int)$id)
            return Article::findOrFail($id);
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
        $article = $this->article_by_path($id);
        $article->comments()->create([
            'username' => $request->get('username'),
            'body' => $request->get('body'),
        ])->notify_admin($article);
        return redirect($request->fullUrl());
    }

    public function delete_comment(Request $request)
    {
        return Comment::destroy($request->get('id'));
    }

    public function tag(Request $request, $tag, $page=1)
    {
        // changing pagination page from route param
        Paginator::currentPageResolver(function() use ($page) {return $page;});
        // getting articles
        $articles = Article::byTag($tag)->paginate();
        // changing routing in rendered pagination view
        $pagination_view = $articles->render();
        // from "/tag/$tag/?page=$page" to "/tag/$tag/page/$page"
        $pagination_view = preg_replace('|/(page/\d+/?)?\?page=(\d+)|', '/page/$2', $pagination_view);
        // replace "/tag/$tag/page/1" to "/tag/$tag"
        $pagination_view = str_replace('/page/1"', '"', $pagination_view);

        //redirect from $_GET paging to new routing
        $_page = $request->get('page');
        if ($_page && (string)abs($_page) === $_page) {
            if ($_page == 1)
                return redirect(route('tag', $tag));
            return redirect(route('tag_paged', [$tag, $_page]));
        }

        $page_title = 'Блог веб разработчика: ' . $tag;
        $view = $request->ajax() ? 'articles.index-content' : 'articles.index';
        if (!$articles->count())
            abort(404);

        // image for og meta
        $tag_image = url('/images/logo.png');
        foreach ($articles as $article) {
            $found_image = $article->getImageUrl();
            if ($found_image != $tag_image) {
                $tag_image = $found_image;
                break;
            }
        }

        return response()
            ->view($view, compact('articles', 'page_title', 'pagination_view', 'page', 'tag', 'tag_image'))
            // forever cookie to identify user star rating
            ->withCookie($this->rating_cookie($request));
    }


    protected function rating_cookie(Request $request){
        $rid = $request->cookie('rid');
        if(!$rid)
            $rid = ip2long($_SERVER['REMOTE_ADDR']);
        return cookie()->forever('rid', $rid);
    }
}
