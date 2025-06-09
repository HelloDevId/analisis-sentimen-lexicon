<?php

namespace App\Helpers;

class LexiconHelper
{
    public static $positives = [
        "bagus",
        "mudah",
        "cepat",
        "ramah",
        "praktis",
        "nyaman",
        "promo",
        "diskon",
        "enak",
        "mantap",
        "bersih",
        "profesional",
        "terbaik",
        "menyenangkan",
        "hebat",
        "puas",
        "cocok",
        "bantu",
        "aman",
        "murah",
        "luar biasa",
        "tepat waktu",
        "memuaskan",
        "rekomendasi",
        "memudahkan",
        "responsif",
        "suka",
        "keren",
        "top",
        "ok",
        "oke",
        "helpful",
        "percaya",
        "memadai",
        "solutif",
        "rapi",
        "bagus sekali",
        "super",
        "pengertian",
        "sopan",
        "gratis",
        "amanah",
        "disiplin",
        "fast respon",
        "recommended",
        "mantul",
        "good",
        "great",
        "amazing",
        "nice",
        "friendly",
        "trusted",
        "worth",
        "memuaskan sekali",
        "terpercaya",
        "memuaskan",
        "enjoy",
        "puas banget",
        "bisa diandalkan",
        "good service",
        "service bagus",
        "driver ramah",
        "pengiriman cepat",
        "harga terjangkau",
        "solusi",
        "penolong",
        "seru",
        "fleksibel",
        "banyak pilihan",
        "fitur lengkap",
        "update cepat",
        "bersahabat"
    ];

    public static $negatives = [
        "error",
        "lama",
        "susah",
        "mahal",
        "buruk",
        "jelek",
        "parah",
        "hilang",
        "lambat",
        "tidak",
        "batal",
        "kurang",
        "bising",
        "kotor",
        "dingin",
        "marah",
        "kecewa",
        "salah",
        "cancel",
        "gagal",
        "ribet",
        "penipuan",
        "tidak ramah",
        "mengecewakan",
        "bohong",
        "lelet",
        "tidak sesuai",
        "tidak bisa",
        "payah",
        "kurang baik",
        "tidak puas",
        "tidak sopan",
        "bikin kesel",
        "kapok",
        "tidak responsif",
        "sangat buruk",
        "menunda",
        "tidak datang",
        "driver kasar",
        "driver telat",
        "driver tidak sopan",
        "driver tidak jujur",
        "driver tidak paham",
        "pelayanan buruk",
        "pelayanan lambat",
        "batal sepihak",
        "fitur error",
        "aplikasi crash",
        "menyesal",
        "kacau",
        "tidak tepat waktu",
        "tidak profesional",
        "parah banget",
        "malas",
        "tidak respons",
        "delay",
        "wait terlalu lama",
        "tidak nyaman",
        "susah login",
        "tidak update",
        "sering error",
        "aplikasi lambat",
        "tidak aman",
        "tidak jelas",
        "tidak rekomen",
        "tidak recommended",
        "driver ugal-ugalan",
        "driver tidak bisa baca map",
        "driver nyasar",
        "penjemputan lama",
        "tidak selesai",
        "tidak bantu",
        "driver tidak datang",
        "driver hilang",
        "tidak dapat promo",
        "harga mahal",
        "kebersihan kurang",
        "makanan dingin",
        "makanan basi",
        "tidak enak",
        "driver marah",
        "tidak ramah",
        "sangat mengecewakan",
        "makanannya jelek",
        "parah sekali"
    ];

    // Stopword sederhana Indonesia
    public static $stopwords = [
        "yang",
        "dan",
        "di",
        "ke",
        "dengan",
        "untuk",
        "pada",
        "dari",
        "ini",
        "itu",
        "atau",
        "juga",
        "ada",
        "karena",
        "sebagai",
        "oleh",
        "dalam",
        "sudah",
        "belum",
        "akan",
        "saya",
        "kamu",
        "dia",
        "mereka",
        "kami",
        "kita",
        "sebuah",
        "bisa",
        "tidak",
        "jadi",
        "hanya",
        "saja",
        "atau",
        "tp",
        "tapi",
        "agar",
        "supaya",
        "semua",
        "lebih",
        "setiap",
        "seperti",
        "masih",
        "banyak",
        "namun",
        "pada",
        "dapat"
    ];

    // Bersihkan teks (lowercase, hilangkan selain huruf/angka/space)
    public static function clean($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    // Preprocessing untuk tabel: ambil hanya kata sentimen (atau kata utama jika tidak ada)
    public static function preprocess($text)
    {
        $cleaned = self::clean($text);
        $tokens = explode(' ', $cleaned);

        // Frasa (kata dua)
        $phrases = array_merge(self::$positives, self::$negatives);

        $foundPhrases = [];
        $foundWords = [];

        // Cek frasa 2 kata (window sliding)
        for ($i = 0; $i < count($tokens) - 1; $i++) {
            $phrase = $tokens[$i] . ' ' . $tokens[$i + 1];
            if (in_array($phrase, $phrases)) {
                $foundPhrases[] = $phrase;
                // skip next word
                $tokens[$i + 1] = '';
            }
        }

        // Cek kata satuan
        foreach ($tokens as $token) {
            if ($token == '') continue; // sudah di-skip
            if (in_array($token, self::$positives) || in_array($token, self::$negatives)) {
                $foundWords[] = $token;
            }
        }

        // Gabungkan hasil frasa dan kata
        $result = array_merge($foundPhrases, $foundWords);

        // Jika kosong, ambil kata utama non-stopword (untuk ringkasan, bukan stopword)
        if (empty($result)) {
            foreach ($tokens as $token) {
                if (!in_array($token, self::$stopwords) && strlen($token) > 2) {
                    $result[] = $token;
                }
            }
        }

        return implode(' ', array_unique($result));
    }

    // Analisis sentimen (hasil cleaned, skor, label)
    public static function analyze($text)
    {
        $text_clean = self::clean($text);

        // Proses frasa dua kata lebih dulu
        $tokens = explode(' ', $text_clean);
        $phrases = array_merge(self::$positives, self::$negatives);

        $pos = 0;
        $neg = 0;
        $skip = [];
        for ($i = 0; $i < count($tokens) - 1; $i++) {
            $phrase = $tokens[$i] . ' ' . $tokens[$i + 1];
            if (in_array($phrase, self::$positives)) {
                $pos++;
                $skip[] = $i;
                $skip[] = $i + 1;
            } elseif (in_array($phrase, self::$negatives)) {
                $neg++;
                $skip[] = $i;
                $skip[] = $i + 1;
            }
        }
        // Hitung kata satuan yang belum di-skip
        foreach ($tokens as $idx => $token) {
            if (in_array($idx, $skip)) continue;
            if (in_array($token, self::$positives)) $pos++;
            if (in_array($token, self::$negatives)) $neg++;
        }

        if ($pos > $neg) return ['score' => $pos - $neg, 'label' => 'positive', 'cleaned' => $text_clean];
        if ($neg > $pos) return ['score' => $pos - $neg, 'label' => 'negative', 'cleaned' => $text_clean];
        return ['score' => 0, 'label' => 'neutral', 'cleaned' => $text_clean];
    }
}
