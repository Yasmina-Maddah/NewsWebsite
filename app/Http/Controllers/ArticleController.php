<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\News;

class ArticleController extends Controller
{
    public function createArticle(Request $request)
    {
        $validated = $request->validate([
            'news_id' => 'required|exists:news,id', 
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);

        $path = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments') : null;

        $article = Article::create([
            'news_id' => $validated['news_id'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'attachment' => $path,
        ]);

        return response()->json(['message' => 'Article created successfully', 'data' => $article], 201);
    }

    public function getArticlesForNews($news_id)
    {
        $articles = Article::where('news_id', $news_id)->get();
        return response()->json($articles);
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $article->delete();
        return response()->json(['message' => 'Article deleted successfully']);
    }
}