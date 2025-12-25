<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function original()
    {
        return Article::where('version', 'original')
            ->select('id', 'title', 'slug', 'content', 'source_url', 'published_at')
            ->get();
    }

    public function storeEnriched(Request $request)
    {
        $data = $request->validate([
            'article_id' => 'required|integer',
            'title' => 'required|string',
            'slug' => 'required|string',
            'summary' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        Article::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['summary'],
            'version' => 'ai_enriched',
            'references' => $data['tags'] ?? [],
            'source_url' => null,
            'published_at' => now(),
        ]);

        return response()->json([
            'status' => 'saved',
            'slug' => $data['slug']
        ]);
    }

    // ✅ ADD THIS METHOD HERE
    public function enriched()
    {
        return Article::where('version', 'ai_enriched')
            ->select('title', 'slug', 'content', 'references', 'published_at')
            ->get();
    }
}
