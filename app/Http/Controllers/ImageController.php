<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (!$request->file('upload')->isValid()) {
            abort(404);
        }
        $imageExtension = $request->file('upload')->getClientOriginalExtension();
        if (!in_array($imageExtension, array('png', 'jpg', 'jpeg'))) {
            return '<script>alert(\'Тип файла запрещен.\');</script>';
        }
        $filename = microtime(true) . '.' . $imageExtension;
        $imageUrl = '/images/uploads/' . $filename;
        $request->file('upload')->move(
            base_path() . '/public/images/uploads/',
            $filename
        );
        return '<script>window.parent.CKEDITOR.tools.callFunction("'
        . $request->get('CKEditorFuncNum', 108) . '", "'
        . $imageUrl . '");</script>';
    }
}
