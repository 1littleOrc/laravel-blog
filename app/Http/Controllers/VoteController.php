<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class VoteController extends Controller
{
    /**
     * Store a new vote value
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $article = Article::findOrFail((int)$request->get('article'));
        } catch (ModelNotFoundException $ex) {
            return response('');
        }

        $value = (int)$request->get('value');
        $rid = $request->cookie('rid');
        if ($value && !empty($rid)) {
            $vote = $article->votes()->where('rid', $rid)->first();
            if ($vote) {
                $vote->value = $value;
                $vote->save();
            } else {
                $article->votes()->create(compact(['value', 'rid']));
            }
            $article->rating = round($article->votes()->avg('value'));
            $article->save();
            return response($article->rating);
        }
        return response('');
    }
}
