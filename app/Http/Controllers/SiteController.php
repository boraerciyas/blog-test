<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{
    private $tags;
    private $recentPosts;

    public function __construct() {
        $this->tags = $this->getTags();
        $this->recentPosts = $this->getRecentPosts();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homepage($searchedTag = null)
    {
        $query = Post::query();

        if ($searchedTag) {
            $query->whereHas('tags', function ($q) use ($searchedTag) {
                $q->where('key', $searchedTag);
            });
        }

        $posts = $query->orderByDesc('created_at')->orderByDesc('id')->paginate(5);
        $recentPosts = $this->recentPosts;
        $tags = $this->tags;

        return view('main', compact(['posts', 'tags', 'recentPosts', 'searchedTag']));
    }

    /**
     * @param string $postSlug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function post(string $postSlug)
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();
        $recentPosts = $this->recentPosts;
        $tags = $this->tags;

        return view('post', compact(['post', 'recentPosts', 'tags']));
    }

    /**
     * @return mixed
     */
    private function getRecentPosts()
    {
        return Cache::remember('recentPosts', 33600, static function () {
            return Post::orderByDesc('created_at')->orderByDesc('id')->take(3)->get();
        });
    }

    /**
     * @return mixed
     */
    private function getTags()
    {
        return Cache::remember('tags', 33600, static function () {
            return Tag::all();
        });
    }
}
