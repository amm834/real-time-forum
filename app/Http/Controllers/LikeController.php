<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class LikeController extends Controller
{
    public function like(Reply $reply)
    {
        // auth()->id
        $reply->likes()->create([
            'user_id' => 1,
        ]);
        return response()->json([
            'message' => 'You liked successfully'
        ]);
    }

    public function unlike(Reply $reply)
    {
        $reply->likes()->where('user_id', 1)->first()->delete();
        return response()->noContent();
    }
}
