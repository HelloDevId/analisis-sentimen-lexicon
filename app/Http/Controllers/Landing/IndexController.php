<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Helpers\LexiconHelper;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('landing.pages.index');
    }

    public function prediction(Request $request)
    {
        $request->validate([
            'statement' => 'required|string|max:1000',
        ], [
            'statement.required' => 'Pernyataan wajib diisi',
            'statement.string' => 'Pernyataan harus berupa teks',
            'statement.max' => 'Pernyataan maksimal 1000 karakter',
        ]);

        $text = $request->input('statement');
        $result = LexiconHelper::analyze($text);

        // Confidence sederhana: abs(score) / jumlah token (maksimal 1)
        $tokens = explode(' ', $result['cleaned']);
        $confidence = count($tokens) ? min(1, abs($result['score']) / count($tokens)) : 0;

        return response()->json([
            'sentiment' => $text,
            'label' => $result['label'],
            'confidence' => round($confidence, 2), // atau sesuai kebutuhan
            'score' => $result['score'],
            'cleaned' => $result['cleaned'],
        ]);
    }
}
