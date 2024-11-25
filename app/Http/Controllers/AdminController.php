<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\News;

class AdminController extends Controller
{
    public function createNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'restricted_age' => 'nullable|integer',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments') : null;

        $news = News::create(array_merge($validated, ['attachment' => $path, 'admin_id' => auth()->id()]));

        return response()->json(['message' => 'News created successfully', 'data' => $news], 201);
    }
}