<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        return view("conversations.conversations", [
            'conversations' => Conversation::all()
        ]);
    }

    public function show(Conversation $conversation)
    {
        return view("conversations.conversation", [
            'conversation' => $conversation
        ]);
    }

    public function bestReply(Reply $reply)
    {
        // if (Gate::denies('update-coversation', $reply->conversation))
        // if (Gate::allows('update-coversation', $reply->conversation))

        $this->authorize('update', $reply->conversation);

        $reply->conversation->best_reply_id = $reply->id;
        $reply->conversation->save();

        return back()->with('message', "Best reply has been set");
        return redirect()->back()->with('message', "Best reply has been set");
    }
}
