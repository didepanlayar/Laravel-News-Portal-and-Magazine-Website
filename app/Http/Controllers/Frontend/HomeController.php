<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $news = News::with('author', 'tags', 'comments')->where('slug', $slug)
            ->activeEntries()->withLocalize()->first();

        $recentNews = News::with('category', 'author')->where('slug', '!=', $news->slug)
            ->activeEntries()->withLocalize()->latest('id')->take(4)->get();

        $popularTags = $this->popularTags();

        $this->countViews($news);

        $nextPost = News::where('id', '>', $news->id)
            ->activeEntries()->withLocalize()->orderBy('id', 'asc')->first();

        $previousPost = News::where('id', '<', $news->id)
            ->activeEntries()->withLocalize()->orderBy('id', 'desc')->first();

        // SweetAlert
        $title = 'Delete Comment!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('frontend.news-details', compact('news', 'recentNews', 'popularTags', 'nextPost', 'previousPost'));
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

    /**
     * Store news comment
     */
    public function comment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:65525'
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        return redirect()->back();
    }

    /**
     * Store news comment reply
     */
    public function reply(Request $request)
    {
        $request->validate([
            'reply' => 'required|string|max:65525'
        ]);

        $comment = new Comment();
        $comment->comment = $request->reply;
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        return redirect()->back();
    }

    /**
     * Delete news comment
     */
    public function destroy(String $id)
    {
        $comment = Comment::findOrFail($id);

        if(Auth::user()->id == $comment->user_id){
            $comment->delete();
        }

        return redirect()->back();
    }
}
