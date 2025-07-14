<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Comment;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\SocialMedia;
use App\Models\Subscriber;
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

        $heroSlider = News::with(['category', 'author'])->where(['is_slider' => 1])
            ->activeEntries()->withLocalize()->latest('id')->take(7)->get();

        $recentNews = News::with('category', 'author')
            ->activeEntries()->withLocalize()->latest('id')->take(6)->get();

        $popularNews = News::with('category', 'author')->where(['is_popular' => 1])
            ->activeEntries()->withLocalize()->latest('id')->take(4)->get();

        $homeSetting = HomeSetting::where('language', getLanguage())->first();

        $categorySection1 = News::where('category_id', $homeSetting->category_section_1)
            ->activeEntries()->withLocalize()->latest('id')->take(8)->get();

        $categorySection2 = News::where('category_id', $homeSetting->category_section_2)
            ->activeEntries()->withLocalize()->latest('id')->take(8)->get();

        $categorySection3 = News::where('category_id', $homeSetting->category_section_3)
            ->activeEntries()->withLocalize()->latest('id')->take(6)->get();

        $categorySection4 = News::where('category_id', $homeSetting->category_section_4)
            ->activeEntries()->withLocalize()->latest('id')->take(4)->get();

        $mostViewed = News::activeEntries()->withLocalize()->orderBy('views', 'DESC')->take(3)->get();

        $socialMedia = SocialMedia::where(['status' => 1, 'language' => getLanguage()])->get();

        $popularTags = $this->popularTags();

        $advertisement = Advertisement::first();

        return view('frontend.home', compact(
            'breakingNews',
            'heroSlider',
            'recentNews',
            'popularNews',
            'categorySection1',
            'categorySection2',
            'categorySection3',
            'categorySection4',
            'mostViewed',
            'socialMedia',
            'popularTags',
            'advertisement'
        ));
    }

    /**
     * News page view
     */
    public function news(Request $request)
    {
        $news = News::query();

        $news->when($request->has('tag'), function($query) use ($request) {
            $query->whereHas('tags', function($query) use ($request) {
                $query->where('name', $request->tag);
            });
        });

        $news->when($request->has('category') && !empty($request->category), function($query) use ($request) {
            $query->whereHas('category', function($query) use ($request) {
                $query->where('slug', $request->category);
            });
        });

        $news->when($request->has('search'), function($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            })->orWhereHas('category', function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        });

        $news = $news->activeEntries()->withLocalize()->paginate(10);

        $categories = Category::where(['status' => 1, 'language' => getLanguage()])->get();

        $recentNews = News::with('category', 'author')
            ->activeEntries()->withLocalize()->latest('id')->take(4)->get();

        $popularTags = $this->popularTags();

        $advertisement = Advertisement::first();

        return view('frontend.news', compact('news', 'recentNews', 'popularTags', 'categories', 'advertisement'));
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

        $relatedPosts = News::where('slug', '!=', $news->slug)->where('category_id', $news->category_id)
            ->activeEntries()->withLocalize()->latest('id')->take(9)->get();

        $socialMedia = SocialMedia::where(['status' => 1, 'language' => getLanguage()])->get();

        $advertisement = Advertisement::first();

        // SweetAlert
        $title = 'Delete Comment!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('frontend.news-details', compact(
            'news',
            'recentNews',
            'popularTags',
            'nextPost',
            'previousPost',
            'relatedPosts',
            'socialMedia',
            'advertisement'
        ));
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

        toast(__('Comment added successfully'), 'success')->width('350')->timerProgressBar();

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

        toast(__('Comment reply successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->back();
    }

    /**
     * Delete news comment
     */
    public function destroy(String $id)
    {
        try {
            $comment = Comment::findOrFail($id);
    
            if(Auth::user()->id == $comment->user_id){
                $comment->delete();
            }

            toast(__('Comment deleted successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $th) {
            toast(__('Comment deleted error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->back();
    }

    /**
     * Subcribe Newsletter
     */
    public function subscribe(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|max:255|unique:subscribers,email'
            ],
            [
                'email.unique' => __('The email has already been subscribe')
            ]
        );

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        toast(__('Subsribe successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->back();
    }
}
