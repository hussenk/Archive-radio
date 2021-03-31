<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Presenter;
use App\Models\Preparation;
use App\Models\File;
use Illuminate\Http\Request;


class SearchController extends Controller
{

    public function index()
    {
        $tag = Tag::all();
        $file = File::orderBy('user_date', 'DESC')->get();
        $presenter = Presenter::all();

        $preparation = Preparation::all();

        return view('search.index')
            ->with('tag', $tag)
            ->with('presenter', $presenter)
            ->with('preparation', $preparation)
            ->with('file', $file);
    }


    public function search(Request $request)
    {
        // request
        $tag = Tag::all();
        $file = File::orderBy('user_date', 'DESC')->get();
        $presenter = Presenter::all();

        $preparation = Preparation::all();

        if ($request->has('title')) {
            $file->where('title', '%' . $request->title . '%')->get();
        }


        return view('search.index')
            ->with('tag', $tag)
            ->with('presenter', $presenter)
            ->with('preparation', $preparation)
            ->with('file', $file);
    }
}
