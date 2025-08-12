<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Car;
  use App\Models\User; // تأكدي من الاستيراد في الأعلى

use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
public function showChat($receiverId)
{
    $userId = Auth::id();

    $messages = Message::where(function($query) use ($userId, $receiverId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', $receiverId);
    })->orWhere(function($query) use ($userId, $receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', $userId);
    })->orderBy('created_at')->get();

    $receiver = User::findOrFail($receiverId); // تجيب بيانات المستقبل كاملة

    return view('chat.show', compact('messages', 'receiver'));
}

public function sendMessage(Request $request, $receiverId)
{
    $request->validate([
        'message' => 'required|string|max:2000',
    ]);

    $userId = Auth::id();

    Message::create([
        'sender_id' => $userId,
        'receiver_id' => $receiverId,
        'message' => $request->message,
    ]);

    return redirect()->back();
}

}
