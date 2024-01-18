<?php

namespace App\Actions\Comment;

use App\DataTransferObjects\CommentData;
use App\Models\Comment;
use App\Models\Recipe;

class UpsertCommentAction
{
    public function handle(CommentData $data, Recipe $recipe, Comment $comment = null): Comment
    {
        return Comment::updateOrCreate(
            [
                'id' => $comment?->id,
            ],
            [
                'body' => $data->body,
                'recipe_id' => $recipe->id,
                'user_id' => auth()->id(),
            ]
        );
    }
}
