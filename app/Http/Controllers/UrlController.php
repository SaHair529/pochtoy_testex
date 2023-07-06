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
            return response()->json(['error' => 'Invalid URL'], 400);

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

        return response()->json(['short_url' => $shortUrl]);
    }
}
