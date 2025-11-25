<?php

namespace App\Domain\Services;

use App\Domain\Contracts\VoiceProcessorInterface;
use HosseinHezami\LaravelGemini\Facades\Gemini;
use Illuminate\Http\UploadedFile;

class VoiceProcessingService implements VoiceProcessorInterface
{
    public function processVoiceInput(UploadedFile $audioFile): array
    {
        $tempPath = storage_path('app/tmp');
        $filePath = $tempPath . '/' . $audioFile->hashName();
        $audioFile->move($tempPath, basename($filePath));

        $uploadResponse = Gemini::files()->upload('audio', $filePath);
        $fileUri = $uploadResponse['audio'] ?? null;

        if (!$fileUri) {
            return ['error' => 'Failed to upload audio'];
        }

        $response = Gemini::text()
            ->prompt("Transcribe this audio: {$fileUri}")
            ->generate();

        dd($response);

        $transcript = $response->content();

        return [
            'amount' => 0,
            'category' => null,
            'description' => '',
            'transcript' => $transcript
        ];
    }
}
