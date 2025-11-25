<?php

namespace App\Http\Controllers;

use App\Application\Services\VoiceTransactionService;
use App\Domain\Services\TransactionService;
use App\Models\Workspace;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private VoiceTransactionService $voiceTransactionService,
        private TransactionService $transactionService
    ) {}

    public function processVoice(Request $request)
    {
        $data = $request->validate([
            "audio" => 'required|file',
        ]);

        $audioFile = $data['audio'];

        $result = $this->voiceTransactionService->processVoiceTransaction(
            $audioFile,
        );

        return response()->json($result);
    }
}
