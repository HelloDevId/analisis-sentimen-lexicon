<?php

namespace App\Helpers;

class LexiconHelper
{
    // Kata/frasa positif khusus kampus dan umum
    public static $positives = [
        // Umum
        "bagus",
        "bersih",
        "rapi",
        "nyaman",
        "baik",
        "cepat",
        "ramah",
        "inovatif",
        "profesional",
        "terjangkau",
        "modern",
        "asyik",
        "aman",
        "menyenangkan",
        "mantap",
        "hebat",
        "memuaskan",
        "luas",
        "indah",
        "seru",
        "kreatif",
        "teratur",
        "lengkap",
        "mendukung",
        "keren",
        "top",
        "oke",
        "ok",
        "terbaik",
        "recommended",
        "super",
        "terawat",
        "disiplin",
        "terorganisir",
        "fleksibel",
        "kompeten",
        "supportif",
        "berpengalaman",
        "aktif",
        "berprestasi",
        "solutif",
        "tepat waktu",
        "update",
        "gratis",
        "pengertian",
        "responsif",
        "bermanfaat",
        "mudah",
        "murah",
        "fast respon",
        "friendly",
        "helpful",
        "menarik",
        "percaya",
        "amanah",
        "worth",
        "bagus sekali",
        // Kampus/fasilitas
        "fasilitas lengkap",
        "fasilitas memadai",
        "perpustakaan bagus",
        "laboratorium lengkap",
        "wifi kencang",
        "kelas nyaman",
        "dosen ramah",
        "parkir luas",
        "toilet bersih",
        "akses mudah",
        "lingkungan nyaman",
        "ruang kelas nyaman",
        "ruang belajar nyaman",
        "ruang diskusi nyaman",
        "ruang baca nyaman",
        "pelayanan baik",
        "pelayanan ramah",
        "pelayanan cepat",
        "pelayanan memuaskan",
        "kegiatan menarik",
        "kegiatan bermanfaat",
        "organisasi aktif",
        "beasiswa banyak",
        "akreditasi baik",
        "mahasiswa aktif",
        "pengajar kompeten",
        "pengajar profesional"
    ];

    // Kata/frasa negatif khusus kampus dan umum, termasuk pola negasi dan keluhan
    public static $negatives = [
        // Umum
        "jelek",
        "kotor",
        "buruk",
        "semrawut",
        "kacau",
        "tidak rapi",
        "tidak bersih",
        "tidak nyaman",
        "tidak baik",
        "mahal",
        "pelan",
        "lambat",
        "lelet",
        "ribet",
        "payah",
        "kurang",
        "kurang baik",
        "kurang bagus",
        "kurang puas",
        "kurang nyaman",
        "kurang memadai",
        "kurang lengkap",
        "tidak ramah",
        "tidak profesional",
        "tidak responsif",
        "tidak disiplin",
        "tidak update",
        "tidak recommended",
        "tidak rekomen",
        "tidak gratis",
        "tidak aman",
        "tidak peduli",
        "tidak mengerti",
        "tidak sesuai",
        "tidak tepat waktu",
        "tidak membantu",
        "tidak ada",
        "tidak pernah",
        "parah",
        "parah banget",
        "parah sekali",
        "mengecewakan",
        "menyebalkan",
        "kecewa",
        "kapok",
        "menyesal",
        "bising",
        "dingin",
        "ramai",
        "terlalu banyak",
        "terbatas",
        "tidak jelas",
        "batal",
        "batal sepihak",
        "gagal",
        "error",
        "sering error",
        "sering rusak",
        "tidak bisa",
        "tidak layak",
        "tidak sesuai harapan",
        "tidak layak pakai",
        "tidak layak huni",
        "tidak layak pakai",
        "tidak layak digunakan",
        // Kampus/fasilitas
        "fasilitas jelek",
        "fasilitas buruk",
        "fasilitas rusak",
        "fasilitas tidak memadai",
        "fasilitas minim",
        "fasilitas kurang",
        "fasilitas tidak lengkap",
        "fasilitas terbatas",
        "fasilitas tidak layak",
        "fasilitas tidak terawat",
        "fasilitas kotor",
        "wifi lemot",
        "wifi lambat",
        "wifi tidak stabil",
        "toilet kotor",
        "kelas panas",
        "kelas sempit",
        "kelas tidak nyaman",
        "ruang kelas kotor",
        "ruang kelas sempit",
        "ruang belajar sempit",
        "ruang diskusi sempit",
        "ruang baca sempit",
        "parkir sempit",
        "parkir mahal",
        "parkir susah",
        "akses sulit",
        "akses susah",
        "pelayanan lambat",
        "pelayanan buruk",
        "pelayanan jelek",
        "pelayanan tidak ramah",
        "dosen tidak ramah",
        "dosen tidak peduli",
        "dosen tidak membantu",
        "dosen jarang hadir",
        "admin tidak ramah",
        "admin lambat",
        "admin susah dihubungi",
        "organisasi tidak aktif",
        "beasiswa jarang",
        "beasiswa sulit",
        "biaya mahal",
        "uang kuliah mahal",
        "biaya kampus mahal",
        "akreditasi jelek",
        "akreditasi buruk",
        "mahasiswa pasif",
        "pengajar tidak kompeten",
        "pengajar tidak profesional",
        // Frasa keluhan/negasi
        "gaada yang bagus",
        "tidak ada yang bagus",
        "tidak ada fasilitas bagus",
        "seharusnya bisa bagus",
        "kita kan bayar",
        "masa gaada yang bagus",
        "masa tidak ada yang bagus",
        "kok gini",
        "kenapa begini",
        "kenapa begitu",
        "nggak bagus",
        "nggak nyaman",
        "gak bagus",
        "gak nyaman",
        "gak ada yang bagus",
        "nggak ada yang bagus",
        "tidak memadai",
        "tidak layak",
        "tidak pernah diperbaiki",
        "sering rusak",
        // Pola keluhan
        "bayar mahal",
        "bayar tapi",
        "sudah bayar",
        "sudah bayar mahal",
        "pelayanan tidak sebanding",
        "fasilitas tidak sesuai",
        "fasilitas tidak sebanding",
        "tidak sesuai ekspektasi",
        "tidak sesuai brosur",
        "tidak sesuai promosi",
        "jauh dari harapan"
    ];

    // Stopword sederhana Indonesia (untuk ringkasan keyword)
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
        "dapat",
        "itu",
        "yang",
        "untuk",
        "karena",
        "sebagai",
        "oleh",
        "dalam",
        "sudah",
        "akan",
        "kami",
        "kita",
        "mereka",
        "sangat"
    ];

    // Bersihkan teks (lowercase, hilangkan selain huruf/angka/space)
    public static function clean($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    // Preprocessing untuk ringkasan: ambil kata/frasa sentimen atau keyword utama
    public static function preprocess($text)
    {
        $cleaned = self::clean($text);
        $tokens = explode(' ', $cleaned);

        // Frasa (2-3 kata)
        $phrases = array_merge(self::$positives, self::$negatives);
        $foundPhrases = [];
        $foundWords = [];

        // Frasa 3 kata
        for ($i = 0; $i < count($tokens) - 2; $i++) {
            $phrase3 = $tokens[$i] . ' ' . $tokens[$i + 1] . ' ' . $tokens[$i + 2];
            if (in_array($phrase3, $phrases)) {
                $foundPhrases[] = $phrase3;
                $tokens[$i] = $tokens[$i + 1] = $tokens[$i + 2] = '';
            }
        }
        // Frasa 2 kata
        for ($i = 0; $i < count($tokens) - 1; $i++) {
            $phrase2 = $tokens[$i] . ' ' . $tokens[$i + 1];
            if (in_array($phrase2, $phrases)) {
                $foundPhrases[] = $phrase2;
                $tokens[$i] = $tokens[$i + 1] = '';
            }
        }
        // Kata satuan sentimen
        foreach ($tokens as $token) {
            if ($token == '') continue;
            if (in_array($token, self::$positives) || in_array($token, self::$negatives)) {
                $foundWords[] = $token;
            }
        }
        $result = array_merge($foundPhrases, $foundWords);

        // Jika kosong, ambil kata utama non-stopword
        if (empty($result)) {
            foreach ($tokens as $token) {
                if (!in_array($token, self::$stopwords) && strlen($token) > 2) {
                    $result[] = $token;
                }
            }
        }
        return implode(' ', array_unique($result));
    }

    // Analisis sentimen kampus: deteksi pola keluhan, negasi, frasa, dan bobot
    public static function analyze($text)
    {
        $text_clean = self::clean($text);
        $tokens = explode(' ', $text_clean);

        // Skor dan frasa
        $pos = 0;
        $neg = 0;
        $skip = [];
        $phrases = array_merge(self::$positives, self::$negatives);

        // Frasa 3 kata
        for ($i = 0; $i < count($tokens) - 2; $i++) {
            $phrase3 = $tokens[$i] . ' ' . $tokens[$i + 1] . ' ' . $tokens[$i + 2];
            if (in_array($phrase3, self::$positives)) {
                $pos += 2; // frasa lebih kuat, bobot 2
                $skip = array_merge($skip, [$i, $i + 1, $i + 2]);
            } elseif (in_array($phrase3, self::$negatives)) {
                $neg += 2;
                $skip = array_merge($skip, [$i, $i + 1, $i + 2]);
            }
        }

        // Frasa 2 kata
        for ($i = 0; $i < count($tokens) - 1; $i++) {
            if (in_array($i, $skip) || in_array($i + 1, $skip)) continue;
            $phrase2 = $tokens[$i] . ' ' . $tokens[$i + 1];
            if (in_array($phrase2, self::$positives)) {
                $pos++;
                $skip = array_merge($skip, [$i, $i + 1]);
            } elseif (in_array($phrase2, self::$negatives)) {
                $neg++;
                $skip = array_merge($skip, [$i, $i + 1]);
            }
        }

        // Pola negasi: "tidak/kurang/gaada/nggak/gak" + kata positif
        for ($i = 0; $i < count($tokens) - 1; $i++) {
            if (in_array($i, $skip) || in_array($i + 1, $skip)) continue;
            if (
                in_array($tokens[$i], ["tidak", "kurang", "gaada", "nggak", "gak"]) &&
                in_array($tokens[$i + 1], self::$positives)
            ) {
                $neg++;
                $skip = array_merge($skip, [$i, $i + 1]);
            }
        }

        // Kata satuan
        foreach ($tokens as $idx => $token) {
            if (in_array($idx, $skip)) continue;
            if (in_array($token, self::$positives)) $pos++;
            if (in_array($token, self::$negatives)) $neg++;
        }

        // Deteksi pola keluhan/komplain dalam kalimat
        $text_lower = strtolower($text);
        $complaint_patterns = [
            'seharusnya',
            'kita kan bayar',
            'masa ',
            'kok ',
            'kenapa',
            'nggak',
            'gak',
            'ga ada',
            'tidak pernah',
            'ga pernah',
            'bayar mahal',
            'sudah bayar',
            'bayar tapi',
            'nggak pernah',
            'nggak ada',
            'gak ada',
            'tidak layak',
            'jauh dari harapan',
            'tidak pernah diperbaiki',
            'sering rusak'
        ];
        foreach ($complaint_patterns as $pattern) {
            if (strpos($text_lower, $pattern) !== false) {
                $neg += 1.5; // bobot keluhan
            }
        }

        // Extra: jika ada lebih dari 1 pola keluhan + ada negatif, bobotkan lebih kuat
        $keluhan_count = 0;
        foreach ($complaint_patterns as $pattern) {
            if (strpos($text_lower, $pattern) !== false) $keluhan_count++;
        }
        if ($keluhan_count > 1 && $neg > 0) $neg += 1;

        // Label
        if ($pos > $neg) $label = "positive";
        elseif ($neg > $pos) $label = "negative";
        else $label = "neutral";

        return [
            'score' => $pos - $neg,
            'label' => $label,
            'cleaned' => $text_clean
        ];
    }
}
