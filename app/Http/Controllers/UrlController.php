<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function shorten(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'full_url' => 'required|url'
        ]);

        if ($validator->fails())
            return response()->json([
                'message' => 'Invalid request parameters',
                'errors' => $validator->errors()
            ], 400);

        $fullUrl = $request->string('full_url');

        if ($existingUrl = Url::where('full', $fullUrl)->first())
            $shortUrl = $existingUrl->short;
        else {
            $shortUrl = $this->generateShortUrl();
            Url::create([
                'full' => $fullUrl,
                'short' => $shortUrl
            ]);
        }

        return response()->json(['short_url' => 'https://'.$shortUrl]);
    }

    private function generateShortUrl(): string
    {
        if (!$lastShortUrl = Url::latest()->value('short'))
            return 'a';

        $carry = true;
        for ($i = strlen($lastShortUrl) - 1; $i >= 0; $i--) {
            $char = $lastShortUrl[$i];
            if ($carry) {
                if ($char === 'z') {
                    $lastShortUrl[$i] = 'a';
                    $carry = true;
                }
                else {
                    $lastShortUrl[$i] = chr(ord($char) + 1);
                    $carry = false;
                }
            }
        }

        if ($carry)
            $lastShortUrl .= 'a';

        return $lastShortUrl;
    }
}
