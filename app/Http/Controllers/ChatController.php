<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{


    // fetch chat history
    public function index(Request $request)
    {
        $lastId = $request->get('last_id'); // id of last msg on client
        $query = ChatMessage::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc');

        if ($lastId) {
            $query->where('id', '>', $lastId); // only newer
        }

        $messages = $query->get();

        // mark admin messages as read
        if ($messages->isNotEmpty()) {
            ChatMessage::where('user_id', Auth::id())
                ->where('sender', 'admin')
                ->whereNull('read_at_user')
                ->update(['read_at_user' => now()]);
        }

        return response()->json($messages);
    }


    // store new message
    public function store(Request $request)
    {
        $message = new ChatMessage();
        $message->user_id = Auth::id();
        $message->sender = 'user'; // mark sender
        $message->message = $request->message;
        $message->save();

        return response()->json(['success' => true]);
    }


    // Render the admin chat page (blade)
    public function page()
    {
        return view('Admin.chat_message');
    }

    // Sidebar list: users who have chatted, with latest message + unread count
    public function threads()
    {
        // Users who have at least one message
        $users = User::whereHas('chatMessages')
            ->withCount(['chatMessages as unread_count' => function ($q) {
                $q->where('sender', 'user')->whereNull('read_at_admin');
            }])
            ->get()
            ->map(function ($user) {
                $latest = ChatMessage::where('user_id', $user->id)
                    ->latest('created_at')->first();
                return [
                    'id'           => $user->id,
                    'name'         => $user->name ?? ('User #' . $user->id),
                    'unread_count' => $user->unread_count,
                    'latest'       => $latest?->message,
                    'latest_at'    => optional($latest)->created_at?->toDateTimeString(),
                ];
            });

        return response()->json($users);
    }

    // Get full conversation with one user
    public function messages(User $user)
    {
        $messages = ChatMessage::where('user_id', $user->id)
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }

    // Admin sends a message
    public function send(Request $request, User $user)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $msg = ChatMessage::create([
            'user_id' => $user->id,
            'sender'  => 'admin',
            'message' => $validated['message'],
            // admin-sent messages are auto-read by admin
            'read_at_admin' => now(),
            // user will read later → null
        ]);

        return response()->json($msg);
    }

    // Mark all messages from this user as read by admin
    public function markRead(User $user)
    {
        ChatMessage::where('user_id', $user->id)
            ->where('sender', 'user')
            ->whereNull('read_at_admin')
            ->update(['read_at_admin' => now()]);

        return response()->json(['ok' => true]);
    }

    // Unread count for badge polling
    public function unreadCount()
    {
        $count = ChatMessage::whereNull('read_at_admin')
            ->where('sender', 'user')
            ->count();

        return response()->json(['count' => $count]);
    }
}
