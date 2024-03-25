<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\CreateChatRoomRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Traits\ApiResponse;
use Exception;

class ChatController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $chats = Chat::with(['users' => function ($q) {
                $q->where('user_id', '!=', auth()->user()->id);
            }
                , 'lastMessage' => function ($q) {
                    $q->first();
                }])->withCount('unreadMessages')->whereHas('users', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->get();
            return $this->returnSuccessRespose('Success', ChatResource::collection($chats), 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
    public function store(CreateChatRoomRequest $request)
    {
        try {
            $data = $request->validated();
            $data['users'][] = auth()->user()->id;
            $chat = Chat::create([]);
            $chat->users()->attach($data['users']);
            return $this->returnSuccessRespose('Success', new ChatResource($chat), 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $chat = Chat::with('users', 'messages')->findOrFail($id);
            return $this->returnSuccessRespose('Success', new ChatResource($chat), 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $chat = Chat::findOrFail($id);
            $chat->delete();
            return $this->returnSuccessRespose('Success', null, 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
}
