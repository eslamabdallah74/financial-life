<?php

namespace App\Domain\Contracts;
use Illuminate\Http\UploadedFile;

interface VoiceProcessorInterface
{
    public function processVoiceInput(UploadedFile $audioContent): array;
}
