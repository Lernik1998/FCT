<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{

    public function inbox()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return Inertia::render('Trainer/MessageInbox', ['users' => $users]);
    }

    public function store(Request $request, User $user)
    {
        $message = new Message;
        $message->sender_id = Auth::user()->id;
        $message->recipient_id = $user->id;
        $message->message = $request->message;
        $message->save();

        broadcast(new MessageSent($message));

        return response()->json($message);
    }

    public function show(User $user)
    {
        $user1Id = Auth::user()->id;
        $user2Id = $user->id;

        $messages = Message::where(function ($query) use ($user1Id, $user2Id) {
            $query->where('sender_id', $user1Id)
                ->where('recipient_id', $user2Id);
        })
            ->orWhere(function ($query) use ($user1Id, $user2Id) {
                $query->where('sender_id', $user2Id)
                    ->where('recipient_id', $user1Id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // Admin

    // public function messageAdmin()
    // {
    //     $users = User::where('id', '!=', Auth::user()->id)->get();
    //     return Inertia::render('Admin/MessageAdmin', ['users' => $users]);
    // }

    // public function storeAdmin(Request $request, User $user)
    // {
    //     $message = new Message;
    //     $message->sender_id = Auth::user()->id;
    //     $message->recipient_id = $user->id;
    //     $message->message = $request->message;
    //     $message->save();

    //     broadcast(new MessageSent($message));

    //     return response()->json($message);
    // }

    // public function showAdmin(User $user)
    // {
    //     $user1Id = Auth::user()->id;
    //     $user2Id = $user->id;

    //     $messages = Message::where(function ($query) use ($user1Id, $user2Id) {
    //         $query->where('sender_id', $user1Id)
    //             ->where('recipient_id', $user2Id);
    //     })
    //         ->orWhere(function ($query) use ($user1Id, $user2Id) {
    //             $query->where('sender_id', $user2Id)
    //                 ->where('recipient_id', $user1Id);
    //         })
    //         ->orderBy('created_at', 'asc')
    //         ->get();

    //     return response()->json($messages);
    // }
}