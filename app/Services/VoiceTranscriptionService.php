<?php

namespace App\Services;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VoiceTranscriptionService
{
    protected $client;

    public function __construct()
    {
        // Initialize Google Cloud Speech client
        // Requires GOOGLE_APPLICATION_CREDENTIALS environment variable
        try {
            $this->client = new SpeechClient();
        } catch (\Exception $e) {
            Log::error('Failed to initialize Speech Client: ' . $e->getMessage());
        }
    }

    /**
     * Transcribe audio file to text
     *
     * @param string $audioFilePath Path to the audio file
     * @param string $languageCode Language code (ar-SA, ar-EG, en-US)
     * @return array ['transcript' => string, 'confidence' => float]
     */
    public function transcribe(string $audioFilePath, string $languageCode = 'ar-SA'): array
    {
        try {
            // Read the audio file
            $audioContent = file_get_contents($audioFilePath);

            // Configure recognition
            $config = new RecognitionConfig([
                'encoding' => AudioEncoding::LINEAR16,
                'sample_rate_hertz' => 16000,
                'language_code' => $languageCode,
                // Enable automatic language detection between Arabic and English
                'alternative_language_codes' => ['en-US', 'ar-EG', 'ar-SA'],
                'enable_automatic_punctuation' => true,
                'model' => 'default',
            ]);

            $audio = new RecognitionAudio([
                'content' => $audioContent,
            ]);

            // Perform the transcription
            $response = $this->client->recognize($config, $audio);

            $transcript = '';
            $confidence = 0;

            foreach ($response->getResults() as $result) {
                $alternatives = $result->getAlternatives();
                if (count($alternatives) > 0) {
                    $transcript .= $alternatives[0]->getTranscript();
                    $confidence = max($confidence, $alternatives[0]->getConfidence());
                }
            }

            if (empty($transcript)) {
                throw new \Exception('No transcription result');
            }

            return [
                'transcript' => trim($transcript),
                'confidence' => $confidence * 100, // Convert to percentage
            ];

        } catch (\Exception $e) {
            Log::error('Voice transcription failed: ' . $e->getMessage());
            throw new \Exception('Failed to transcribe audio: ' . $e->getMessage());
        }
    }

    /**
     * Detect the language from audio
     *
     * @param string $audioFilePath
     * @return string Language code (ar or en)
     */
    public function detectLanguage(string $audioFilePath): string
    {
        // This is a simplified version
        // In production, you might want to use language detection API
        try {
            $result = $this->transcribe($audioFilePath, 'ar-SA');

            // Simple heuristic: if transcript contains Arabic characters, it's Arabic
            if (preg_match('/[\x{0600}-\x{06FF}]/u', $result['transcript'])) {
                return 'ar';
            }

            return 'en';
        } catch (\Exception $e) {
            return 'ar'; // Default to Arabic
        }
    }

    /**
     * Store uploaded audio file
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string Stored file path
     */
    public function storeAudioFile($file): string
    {
        $path = $file->store('audio_recordings', 'public');
        return $path;
    }

    public function __destruct()
    {
        if ($this->client) {
            $this->client->close();
        }
    }
}
