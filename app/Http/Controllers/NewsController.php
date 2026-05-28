<?php

namespace App\Http\Controllers;

use App\Models\NewsComment;
use App\Models\NewsPost;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('pages.news.index', [
            'settings' => SiteSetting::current(),
            'posts' => NewsPost::query()->latestPublished()->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $post = NewsPost::query()
            ->published()
            ->where('slug', $slug)
            ->with(['approvedComments'])
            ->first();

        abort_unless($post, 404);

        return view('pages.news.show', [
            'settings' => SiteSetting::current(),
            'post' => $post,
            'comments' => $post->approvedComments,
        ]);
    }

    public function storeComment(Request $request, string $slug): RedirectResponse
    {
        $post = NewsPost::findPublishedBySlug($slug);

        abort_unless($post, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        NewsComment::query()->create([
            'news_post_id' => $post->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'is_approved' => true,
        ]);

        return redirect()
            ->route('news.show', $post->slug)
            ->with('comment_success', 'Thanks for your comment. It is now visible below.')
            ->withFragment('comments');
    }
}
