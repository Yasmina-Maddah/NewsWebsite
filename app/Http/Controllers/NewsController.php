<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all(); 
        return response()->json($news);
    }

    public function show($id)
    {
        $news = News::findOrFail($id); 
        return response()->json($news);
    }
}
