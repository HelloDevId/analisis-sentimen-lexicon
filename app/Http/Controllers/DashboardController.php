<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Comment::count();
        $positive = Comment::where('sentiment_label', 'positive')->count();
        $negative = Comment::where('sentiment_label', 'negative')->count();
        $neutral  = Comment::where('sentiment_label', 'neutral')->count();
        $comments = Comment::all();

        // Prepare word frequency for each label
        $getWords = function ($label) {
            $texts = Comment::where('sentiment_label', $label)->pluck('cleaned_comment')->toArray();
            $allWords = [];
            foreach ($texts as $text) {
                $words = explode(' ', $text);
                foreach ($words as $word) {
                    if (strlen($word) > 2) { // skip very short words
                        if (!isset($allWords[$word])) $allWords[$word] = 0;
                        $allWords[$word]++;
                    }
                }
            }
            arsort($allWords);
            return $allWords;
        };

        $wordcloud_positive = $getWords('positive');
        $wordcloud_negative = $getWords('negative');
        $wordcloud_neutral  = $getWords('neutral');

        return view('admin2.pages.dashboard', [
            'total' => $total,
            'positive' => $positive,
            'negative' => $negative,
            'neutral' => $neutral,
            'comments' => $comments,
            'wordcloud_positive' => $wordcloud_positive,
            'wordcloud_negative' => $wordcloud_negative,
            'wordcloud_neutral'  => $wordcloud_neutral,
        ]);
    }
}
