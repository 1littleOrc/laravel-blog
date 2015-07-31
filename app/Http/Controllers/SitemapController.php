<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Display sitemap.xml
     *
     * @return Response
     */
    public function index()
    {
        $sitemap = App::make("sitemap");
        if (!$sitemap->isCached()) {

            // main page
            $home = URL::to('/');
            $sitemap->add($home, date('c', time()), '1.0', 'daily');

            $perPage = 15;
            // tags
            foreach (config('sitemap.tags') as $tag => $label) {
                $url = route('tag', $tag);
                $sitemap->add($url, date('c', time()), '0.7', 'weekly');
                // pages of tag
                $pages = ceil(Article::byTag($tag)->count() / $perPage);
                if ($pages > 1)
                    for ($page = 2; $page <= $pages; $page++)
                        $sitemap->add("$url?page=$page", date('c', time()), '0.7', 'weekly');
            }
            // all posts
            $posts = Article::all();
            foreach ($posts as $post) {
                if ($post->path)
                    $url = route('post', $post->path);
                else
                    $url = route('post_by_id', $post->id);
                $date = max(strtotime($post->created_at), strtotime($post->updated_at));
                $sitemap->add($url, date('c', $date), '0.9', 'daily');
            }

            // archive pages
            $pages = ceil(count($posts) / $perPage);
            if ($pages > 1)
                for ($page = 2; $page <= $pages; $page++)
                    $sitemap->add("$home?page=$page", date('c', time()), '0.8', 'daily');
        }
        return $sitemap->render('xml');
    }
}
