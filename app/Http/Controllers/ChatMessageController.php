<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\ChatMessageRequest;
use App\Http\Resources\ChatMessageResource;
use App\Models\ChatMessage;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    use ApiResponse;

    public function store(ChatMessageRequest $request){
        try {
            $message = ChatMessage::create($request->validated());
            return $this->returnSuccessRespose('Success' , new ChatMessageResource($message));
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
}
