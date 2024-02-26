<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Whatsapp;
use App\Models\SMS;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{
    public function generateHash(Request $request)
    {
        try {
            $originalUrl = $request->input('url');
            $request->validate([
                'url' => 'required|url',
            ]);

            $hash = substr(hash('sha256', $originalUrl),0,6);

            // $url = Url::firstOrNew(
            //     ['original_url' => $originalUrl],
            //     ['hash' => $hash]
            // );
            $url->save();
            if ($url->id) {
                return response()->json([
                    'hash' => url($hash)
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Something goes wrong. Please try after sometime.'
                ], 500);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function redirect($hash)
    {
        $url = Url::where('hash', $hash)->first();
        if (!$url) {
            return response()->json([
                'error' => 'URL not found'
            ], 404);
        }

        $url->update([
            'clicks' => $url->clicks + 1,
            'open' => $url->open + 1
        ]);

        return redirect($url->original_url);
    }


    public function redirect_whatsapp($hash)
    {
        $url = Whatsapp::where('hash', $hash)->first();
        if (!$url) {
            return response()->json([
                'error' => 'URL not found'
            ], 404);
        }

        $url->update([
            'clicks' => $url->clicks + 1,
            'open' => $url->open + 1
        ]);

        return redirect($url->original_url);
    }


        public function redirect_sms($hash)
    {
        $url = SMS::where('hash', $hash)->first();
        if (!$url) {
            return response()->json([
                'error' => 'URL not found'
            ], 404);
        }

        $url->update([
            'clicks' => $url->clicks + 1,
            'open' => $url->open + 1
        ]);

        return redirect($url->original_url);
    }

    public function getStatsForHash($hash)
    {
        $url = Url::where('hash', $hash)->first();
        if (!$url) {
            return response()->json([
                'error' => 'URL not found'
            ], 404);
        }else{
            return response()->json([
                'original_url' => $url->original_url,
                'hash_url' => url($url->hash),
                'total_clicks' => $url->clicks,
                'last_clicked' => Carbon::createFromDate($url->updated_at)->toDateTimeString()
            ], 200);
        }
    }

}
