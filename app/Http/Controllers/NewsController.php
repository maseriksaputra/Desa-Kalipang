<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display the specified news article.
     */
    public function show(News $news)
    {
        // Get 3 latest news for the sidebar/related news section
        $latestNews = News::where('id', '!=', $news->id)->latest()->take(3)->get();
        
        return view('news.show', compact('news', 'latestNews'));
    }
}
