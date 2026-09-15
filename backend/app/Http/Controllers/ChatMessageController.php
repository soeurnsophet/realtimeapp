<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $receiver_id)
    {
        $sender_id = auth()->user()->id;

        $messages = ChatMessage::where(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id);
        })
            ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                    ->where('receiver_id', $sender_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = ChatMessage::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMessage $chatMessage)
    {
        //
    }
}
