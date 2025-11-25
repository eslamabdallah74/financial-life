<?php

namespace App\Application\Services;

use App\Domain\Services\VoiceProcessingService;
use App\Domain\Services\TransactionService;
use App\Models\Workspace;
use Illuminate\Http\UploadedFile;


class VoiceTransactionService
{
    public function __construct(
        private VoiceProcessingService $voiceProcessor,
        private TransactionService $transactionService
    ) {}

    public function processVoiceTransaction(UploadedFile $audioContent): array
    {
        // Process the voice input
        $transactionData = $this->voiceProcessor->processVoiceInput($audioContent);

        // Create the transaction
        $transaction = $this->transactionService->createFromVoiceData(
            $transactionData,
        );

        return [
            'transaction' => $transaction,
            'data' => $transactionData,
        ];
    }
}
