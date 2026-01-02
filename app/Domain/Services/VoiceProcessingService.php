<?php

namespace App\Domain\Services;

use App\Domain\Contracts\VoiceProcessorInterface;
use HosseinHezami\LaravelGemini\Facades\Gemini;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VoiceProcessingService implements VoiceProcessorInterface
{
    public function processVoiceInput(UploadedFile $audioFile): array
    {
        try {
            // 1. Save locally first (Permanent backup)
            $directory = 'voice_recordings/' . auth()->id();
            $filename = time() . '_' . uniqid() . '_' . $audioFile->getClientOriginalName();
            Storage::disk('local')->putFileAs($directory, $audioFile, $filename);
            $localAudioPath = $directory . '/' . $filename;

            // 2. Prepare for Gemini (Copy to temp)
            // Gemini needs local file path for upload
            $tempPath = storage_path('app/tmp');
            if (!file_exists($tempPath)) {
                mkdir($tempPath, 0755, true);
            }
            $tempFilePath = $tempPath . '/' . uniqid() . '.mp3';
            copy($audioFile->getRealPath(), $tempFilePath);

            // 3. Process with Gemini AI using the builder pattern
            // We use 'gemini-flash-latest' as verified in available models
            $result = Gemini::text()
                ->model('gemini-flash-latest')
                ->prompt('Extract transaction details: amount, type (income/expense), description (summary), and date (YYYY-MM-DD). Return as JSON.')
                ->upload('audio', $tempFilePath)
                ->generate();

            $transcript = $result->content();

            // 5. Cleanup
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }

            // 6. Simple parsing
            return $this->simpleParse($transcript, $localAudioPath);

        } catch (\Exception $e) {
            Log::error('AI Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return [
                'error' => true,
                'message' => 'Processing failed: ' . $e->getMessage(),
                'details' => $e->getMessage()
            ];
        }
    }

    private function simpleParse($response, $audioPath)
    {
        // Try JSON decode
        if (preg_match('/\{.*\}/s', $response, $matches)) {
            $json = json_decode($matches[0], true);
            if ($json) {
                return [
                    'type' => $json['type'] ?? 'expense',
                    'amount' => $json['amount'] ?? 0,
                    'description' => $json['description'] ?? '',
                    'transaction_date' => $json['date'] ?? $json['transaction_date'] ?? date('Y-m-d'),
                    'category_name' => null, // User said ignore category
                    'ai_confidence_score' => 80,
                    'transcript' => $response,
                    'audio_file_path' => $audioPath
                ];
            }
        }

        // Fallback
        return [
            'type' => 'expense',
            'amount' => 0,
            'description' => $response,
            'transaction_date' => date('Y-m-d'),
            'category_name' => null,
            'ai_confidence_score' => 0,
            'transcript' => $response,
            'audio_file_path' => $audioPath
        ];
    }
}
