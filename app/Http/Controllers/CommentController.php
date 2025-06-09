<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Helpers\LexiconHelper;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return view('admin2.pages.sentiment', [
            'comments' => $comments,
        ]);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt|max:4096',
        ]);

        set_time_limit(0);
        $file = $request->file('csv');
        $handle = fopen($file, 'r');
        $imported = 0;
        $errors = [];
        $rowNum = 0;

        // Optional: cek dan skip header jika ada
        $header = fgetcsv($handle);
        if ($header && strtolower(trim($header[0])) === 'kalimat') {
            // skip header
        } else {
            // tidak ada header, proses baris pertama
            rewind($handle);
        }

        while (($line = fgetcsv($handle)) !== false) {
            $rowNum++;
            $comment = trim($line[0] ?? '');
            if ($comment === '') continue;

            try {
                $result = \App\Helpers\LexiconHelper::analyze($comment);
                $preprocessed = \App\Helpers\LexiconHelper::preprocess($comment);

                // Validasi hasil, jika cleaned/preprocessed kosong, anggap error
                if ($preprocessed === '') {
                    $errors[] = "Baris $rowNum: cleaned gagal (mungkin format kalimat tidak benar)";
                    continue;
                }

                \App\Models\Comment::create([
                    'user_id' => auth()->id(),
                    'original_comment' => $comment,
                    'cleaned_comment' => $preprocessed,
                    'sentiment_score' => $result['score'],
                    'sentiment_label' => $result['label'],
                ]);

                $imported++;
            } catch (\Throwable $e) {
                $errors[] = "Baris $rowNum: " . $e->getMessage();
            }
        }
        fclose($handle);

        // Flash message untuk hasil upload
        $msg = "Import berhasil: $imported kalimat.";
        if ($errors) {
            $msg .= "<br>Beberapa baris gagal diimport:<br>" . implode('<br>', $errors);
        }
        return redirect()->back()->with('import_msg', $msg);
    }

    // public function importCsv(Request $request)
    // {
    //     $request->validate([
    //         'csv' => 'required|file|mimes:csv,txt|max:2048',
    //     ]);

    //     $file = $request->file('csv');
    //     $handle = fopen($file, 'r');
    //     $imported = [];
    //     while (($line = fgetcsv($handle)) !== FALSE) {
    //         $comment = $line[0];
    //         $result = \App\Helpers\LexiconHelper::analyze($comment);
    //         $preprocessed = \App\Helpers\LexiconHelper::preprocess($comment);

    //         $commentObj = \App\Models\Comment::create([
    //             'user_id' => Auth::id(),
    //             'original_comment' => $comment,
    //             'cleaned_comment' => $preprocessed, // simpan hasil preprocess
    //             'sentiment_score' => $result['score'],
    //             'sentiment_label' => $result['label'],
    //         ]);

    //         // Confidence sederhana: |score| / jumlah kata dalam preprocessed (maks 1)
    //         $tokens = explode(' ', $preprocessed);
    //         $confidence = count($tokens) ? min(1, abs($result['score']) / count($tokens)) : 0;

    //         // Kirim data ke frontend untuk update tabel
    //         $imported[] = [
    //             'sentiment' => $commentObj->original_comment,
    //             'preprocessed' => $preprocessed,
    //             'score' => $result['score'],
    //             'label' => $result['label'],
    //             'confidence' => round($confidence, 2),
    //         ];
    //     }
    //     fclose($handle);

    //     return response()->json(['status' => 'success', 'imported' => $imported]);
    // }

    public function deleteAll()
    {
        // hapus semua komentar
        Comment::truncate();
        return redirect()->route('sentiment')->with('delete', 'All comments deleted successfully.');
    }
}
