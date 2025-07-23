<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ChatbotService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    protected $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function start()
    {
        $sessionId = Str::uuid();
        $step = $this->chatbotService->startChat();

        return response()->json([
            'session_id' => $sessionId,
            'step' => $step
        ]);
    }

    public function answer(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|string',
            'step_id' => 'required|string',
            'answer' => 'required'
        ]);

        $nextStep = $this->chatbotService->processStep(
            $validated['step_id'],
            $validated['answer'],
            $validated['session_id']
        );

        return response()->json(['step' => $nextStep]);
    }
}
