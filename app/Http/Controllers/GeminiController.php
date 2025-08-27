<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    public function generateDescription(Request $request)
    {
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'language' => 'nullable|string',
        ]);

        $brand = $request->input('brand');
        $model = $request->input('model');
        $language = strtolower($request->input('language', 'english'));
        $apiKey = env('GEMINI_API_KEY');

        if ($language === 'sinhala') {
            $prompt = "මෙම වේලාවට වඩාත් වෘත්තීයමය, පැහැදිළි සහ පාරිභෝගිකයින්ට ආකර්ෂණීය වන නිෂ්පාදන විස්තරයක් $brand බ්‍රෑන්ඩ් එකේ $model මොඩලය සඳහා සිංහලෙන් ලිවීම.";
        } else {
            $prompt = "Write a clear, professional, and customer-friendly product description for the brand $brand, model $model in simple English without markdown or line breaks.";
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-goog-api-key' => $apiKey,
        ])->withOptions([
            'verify' => false,
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $description = $data['candidates'][0]['content'] ?? 'No description generated';
            return response()->json(['description' => $description]);
        } else {
            return response()->json(['error' => 'Failed to generate description'], 500);
        }
    }
}
