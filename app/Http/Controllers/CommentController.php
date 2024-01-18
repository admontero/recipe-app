<?php

namespace App\Http\Controllers;

use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Comment\UpsertCommentAction;
use App\DataTransferObjects\CommentData;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Recipe $recipe)
    {
        $comments = Comment::select('id', 'body', 'user_id', 'created_at')
            ->with('user:id,name')
            ->where('recipe_id', $recipe->id)
            ->latest('created_at')
            ->paginate(10);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $comments->transform(function (Comment $comment) {
                    return [
                        'id' => $comment->id,
                        'body' => $comment->body,
                        'user_id' => $comment->user_id,
                        'user_name' => $comment->user->name,
                        'created_at' => $comment->created_at->diffForHumans(),
                    ];
                }),
                'meta' => [
                    'total' => $comments->total(),
                    'per_page' => $comments->perPage(),
                    'current_page' => $comments->currentPage(),
                    'next_page_url' => $comments->nextPageUrl(),
                    'path' => $comments->path(),
                ],
            ], 200);
        }

        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Recipe $recipe, UpsertCommentAction $upsertCommentAction): JsonResponse
    {
        $this->authorize('create', Comment::class);

        if ($request->wantsJson()) {
            $comment = $upsertCommentAction->handle(CommentData::fromRequest($request), $recipe);

            return response()->json([
                'id' => $comment->id,
                'body' => $comment->body,
                'user_name' => $comment->user->name,
                'user_id' => $comment->user_id,
                'created_at' => $comment->created_at->diffForHumans(),
            ], 201);
        }

        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Recipe $recipe, Comment $comment, UpsertCommentAction $upsertCommentAction): JsonResponse
    {
        $this->authorize('update', $comment);

        if ($request->wantsJson()) {
            $comment = $upsertCommentAction->handle(CommentData::fromRequest($request), $recipe, $comment);

            return response()->json([
                'id' => $comment->id,
                'body' => $comment->body,
                'user_id' => $comment->user_id,
                'user_name' => $comment->user->name,
                'created_at' => $comment->created_at->diffForHumans(),
            ], 200);
        }

        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe, Comment $comment, DeleteCommentAction $deleteCommentAction): JsonResponse
    {
        $this->authorize('delete', $comment);

        if (request()->wantsJson()) {
            $deleteCommentAction->handle($comment);

            return response()->json([], 204);
        }

        return abort(404);
    }
}
