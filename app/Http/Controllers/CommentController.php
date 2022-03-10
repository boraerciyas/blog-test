<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'nullable|email|max:255',
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_comment_id' => 'sometimes|exists:comments,id'
        ]);

        $parentComment = isset($data['parent_comment_id']) ? Comment::find($data['parent_comment_id']) : null;
        $level = ($parentComment) ? $parentComment->level + 1 : 0;
        $nestedLevel = (int)getenv('NESTED_COMMENT_COUNT', 3) - 1;

        if ($level > $nestedLevel) {
            return response()->json([
                'success' => false,
                'msg' => "Nested comments can be up to " . ($nestedLevel + 1) . " layers only"]);
        }

        $comment = new Comment;
        $comment->parent_comment_id = isset($data['parent_comment_id']) ? $data['parent_comment_id'] : null;
        $comment->level = $level;
        $comment->user_name = $data['user_name'];
        $comment->user_email = $request['user_email'];
        $comment->content = $data['content'];

        $post = Post::find($data['post_id']);
        $saved = $post->comments()->save($comment);

        return response()->json(['success' => (bool)$saved, 'data' => $saved]);
    }

    /**
     * @param int $post
     * @param int|null $parentCommentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments(int $post, ?int $parentCommentId = null): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($post);

        $replies = $post->comments()->with('replies')->orderBy('comments.created_at', 'DESC')->get();

        if ($parentCommentId) {
            $replies = Comment::find($parentCommentId)->replies()->with('replies')->get();
        }

        return response()->json($replies);
    }
}
