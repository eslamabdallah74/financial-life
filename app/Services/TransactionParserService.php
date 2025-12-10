<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use GeminiAPI\Laravel\Facades\Gemini;
use App\Models\Category;

class TransactionParserService
{
    /**
     * Parse transaction from transcribed text using AI
     *
     * @param string $transcript The transcribed text
     * @param int $workspaceId Workspace ID for category matching
     * @return array Parsed transaction data
     */
    public function parse(string $transcript, int $workspaceId): array
    {
        try {
            // Get available categories for this workspace
            $categories = Category::where('workspace_id', $workspaceId)->get();

            $categoryList = $categories->map(function ($cat) {
                return sprintf(
                    "- %s (%s / %s) - type: %s",
                    $cat->name,
                    $cat->name_ar ?? '',
                    $cat->name_en ?? '',
                    $cat->type
                );
            })->join("\n");

            // Build the prompt for Gemini
            $prompt = $this->buildPrompt($transcript, $categoryList);

            // Use Gemini API to parse the transaction
            $response = Gemini::generateText($prompt);

            // Parse the AI response
            $parsed = $this->parseAIResponse($response, $categories);

            return $parsed;

        } catch (\Exception $e) {
            Log::error('Transaction parsing failed: ' . $e->getMessage());
            throw new \Exception('Failed to parse transaction: ' . $e->getMessage());
        }
    }

    /**
     * Build the AI prompt for transaction parsing
     */
    protected function buildPrompt(string $transcript, string $categoryList): string
    {
        return <<<PROMPT
You are an AI assistant helping to parse financial transactions from voice input in Arabic and English.

Analyze the following voice transcript and extract:
1. Transaction type (income or expense)
2. Amount (extract numeric value, handle Arabic numerals ٠١٢٣٤٥٦٧٨٩ and words like ألف/thousand, مليون/million)
3. Category (match to one of the available categories below)
4. Clean description

Voice Transcript:
{$transcript}

Available Categories:
{$categoryList}

Common Arabic number words:
- واحد/one = 1, اتنين/two = 2, ثلاثة/three = 3, أربعة/four = 4, خمسة/five = 5
- ستة/six = 6, سبعة/seven = 7, ثمانية/eight = 8, تسعة/nine = 9, عشرة/ten = 10
- عشرين/twenty = 20, ثلاثين/thirty = 30, أربعين/forty = 40, خمسين/fifty = 50
- مية/hundred = 100, ألف/thousand = 1000, مليون/million = 1000000
- جنيه/pound, ريال/riyal, درهم/dirham, دولار/dollar

Income indicators in Arabic: استلمت, حصلت, أخذت, راتب, دخل
Expense indicators in Arabic: دفعت, اشتريت, صرفت, مصروف

Respond ONLY with a JSON object in this exact format (no markdown, no explanation):
{
  "type": "income" or "expense",
  "amount": numeric value,
  "category_name": "exact category name from the list",
  "description": "clean, concise description",
  "confidence": 0-100
}

Examples:
Input: "استلمت ١٠ آلاف من الشغل النهارده"
Output: {"type":"income","amount":10000,"category_name":"Salary","description":"Received 10,000 from work","confidence":95}

Input: "دفعت ٢٠ دولار في السوبر ماركت"
Output: {"type":"expense","amount":20,"category_name":"Groceries","description":"Paid \$20 at supermarket","confidence":90}

Input: "I got 10k from my job today"
Output: {"type":"income","amount":10000,"category_name":"Salary","description":"Received 10k from job","confidence":95}

Now parse this transcript and respond with ONLY the JSON:
PROMPT;
    }

    /**
     * Parse the AI response and convert to structured data
     */
    protected function parseAIResponse(string $response, $categories): array
    {
        // Clean the response - remove markdown code blocks if present
        $cleaned = preg_replace('/```json\s*|\s*```/', '', $response);
        $cleaned = trim($cleaned);

        // Try to find JSON in the response
        if (preg_match('/\{[^}]+\}/', $cleaned, $matches)) {
            $cleaned = $matches[0];
        }

        try {
            $data = json_decode($cleaned, true);

            if (!$data) {
                throw new \Exception('Invalid JSON response from AI');
            }

            // Find the matching category
            $categoryName = $data['category_name'] ?? '';
            $category = $categories->first(function ($cat) use ($categoryName) {
                return strcasecmp($cat->name, $categoryName) === 0 ||
                    strcasecmp($cat->name_ar ?? '', $categoryName) === 0 ||
                    strcasecmp($cat->name_en ?? '', $categoryName) === 0;
            });

            // If category not found by name, try to match by type
            if (!$category) {
                $type = $data['type'] ?? 'expense';
                $category = $categories->where('type', $type)->first()
                    ?? $categories->first();
            }

            return [
                'type' => $data['type'] ?? 'expense',
                'amount' => floatval($data['amount'] ?? 0),
                'category_id' => $category->id ?? null,
                'description' => $data['description'] ?? '',
                'confidence' => intval($data['confidence'] ?? 50),
            ];

        } catch (\Exception $e) {
            Log::error('Failed to parse AI response: ' . $e->getMessage() . ' | Response: ' . $cleaned);

            // Return a fallback response
            return [
                'type' => 'expense',
                'amount' => 0,
                'category_id' => $categories->first()->id ?? null,
                'description' => 'Failed to parse transaction',
                'confidence' => 0,
            ];
        }
    }

    /**
     * Convert Arabic numerals to Western numerals
     */
    public function convertArabicNumerals(string $text): string
    {
        $arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $westernNumerals = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($arabicNumerals, $westernNumerals, $text);
    }

    /**
     * Extract amount from text (fallback method)
     */
    public function extractAmount(string $text): float
    {
        // Convert Arabic numerals first
        $text = $this->convertArabicNumerals($text);

        // Look for numbers
        if (preg_match('/(\d+(?:[,،]\d+)*(?:\.\d+)?)/', $text, $matches)) {
            $amount = str_replace([',', '،'], '', $matches[1]);
            return floatval($amount);
        }

        return 0;
    }
}
