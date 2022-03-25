<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $data = $request->validate([
            'body' => 'required',
            'user_id' => 'required',
            'question_id' => 'required'
        ]);
        $question = $question->replies()->create($data);
        return response($question, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return response(new ReplyResource($reply));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        $data = $request->validate([
            'body' => 'required',
            'user_id' => 'required',
        ]);
        $reply->update($data);
        return response()->json([
            'message' => 'Reply updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response()->noContent();
    }
}
