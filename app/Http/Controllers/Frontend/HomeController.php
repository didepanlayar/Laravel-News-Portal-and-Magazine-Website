<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Index view
     */
    public function index()
    {
        $breakingNews = News::where(['is_breaking' => 1])
            ->activeEntries()->withLocalize()->latest('id')->take(9)->get();

        return view('frontend.home', compact('breakingNews'));
    }

    /**
     * News details view
     */
    public function show(string $slug)
    {
        $news = News::with('author', 'tags')->where('slug', $slug)
            ->activeEntries()->withLocalize()->first();

        $recentNews = News::with('category', 'author')->where('slug', '!=', $news->slug)
            ->activeEntries()->withLocalize()->latest('id')->take(4)->get();

        $popularTags = $this->popularTags();

        $this->countViews($news);

        return view('frontend.news-details', compact('news', 'recentNews', 'popularTags'));
    }

    /**
     * News count views
     */
    public function countViews($news)
    {
        if(session()->has('viewed')) {
            $postIds =  session('viewed');

            if(!in_array($news->id, $postIds)) {
                $postIds[] = $news->id;
                $news->increment('views');
            }

            session(['viewed' => $postIds]);
        } else {
            session(['viewed' => [$news->id]]);
            $news->increment('views');
        }
    }

    /**
     * Get pupular tags by language
     */
    public function popularTags()
    {
        return DB::table('tags')
            ->join('news_tags', 'tags.id', '=', 'news_tags.tag_id')
            ->select('tags.name', DB::raw('COUNT(news_tags.tag_id) as count'))
            ->where('tags.language', getLanguage())
            ->groupBy('tags.id', 'tags.name')
            ->orderByDesc('count')
            ->take(15)
            ->get();
    }
}
