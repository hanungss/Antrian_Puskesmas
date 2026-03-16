<?php

$file = "antrian.txt";

if(!file_exists($file)){
    file_put_contents($file,"0|-");
}

$data = file_get_contents($file);
list($nomor,$loket) = explode("|",$data);

$action = $_GET['action'] ?? '';

// if($action == "next"){

//     $loket = $_GET['loket'];

//     $nomor = (int)$nomor + 1;

//     file_put_contents($file,$nomor."|".$loket);

//     echo json_encode([
//         "nomor"=>$nomor,
//         "loket"=>$loket
//     ]);

//     exit;
// }

if($action == "before"){
    $loket = $_GET['loket'];
    $nomor = (int)$nomor - 1;
    file_put_contents($file, $nomor."|".$loket);

    // Kirim data ke JSON agar Dashboard mendeteksi
    $res = ["nomor" => (string)$nomor, "loket" => $loket, "panggil" => time()];
    file_put_contents("antrian.json", json_encode($res));

    echo json_encode($res);
    exit;
}

// Pastikan setiap action di api.php juga mengupdate antrian.json
// Contoh untuk bagian 'next' (berlaku juga untuk before):
if($action == "next"){
    $loket = $_GET['loket'];
    $nomor = (int)$nomor + 1;
    file_put_contents($file, $nomor."|".$loket);

    // Kirim data ke JSON agar Dashboard mendeteksi
    $res = ["nomor" => (string)$nomor, "loket" => $loket, "panggil" => time()];
    file_put_contents("antrian.json", json_encode($res));

    echo json_encode($res);
    exit;
}

// Untuk bagian 'repeat' sudah benar, pastikan filenya konsisten 'antrian.json'
if($action == "repeat"){
    $nomor_sekarang = explode("|", file_get_contents("antrian.txt"))[0];
    $loket = $_GET['loket'] ?? 'A';
    $data = ["nomor" => $nomor_sekarang, "loket" => $loket, "panggil" => time()];
    file_put_contents("antrian.json", json_encode($data));
    echo json_encode($data);
    exit;
}

// if($action == "ulangi"){

//     $loket = $_GET['loket'];

//     $nomor = (int)$nomor - 0;

//     file_put_contents($file,$nomor."|".$loket);

//     echo json_encode([
//         "nomor"=>$nomor,
//         "loket"=>$loket
//     ]);

//     exit;
// }

// if($action == "repeat"){

//     $loket = $_GET['loket'];

//     echo json_encode([
//         "nomor"=>$nomor,
//         "loket"=>$loket
//     ]);

//     exit;
// }

if($action == "repeat"){
    // 1. Ambil nomor terakhir dari file txt
    $nomor_sekarang = file_exists("antrian.txt") ? file_get_contents("antrian.txt") : "0";
    $loket = $_GET['loket'] ?? 'A';

    // 2. Buat data JSON dengan timestamp 'panggil' agar dashboard merespon
    $data = [
        "nomor" => $nomor_sekarang,
        "loket" => $loket,
        "panggil" => time() // Menggunakan detik saat ini sebagai ID unik
    ];

    // 3. Simpan ke file JSON agar bisa dibaca dashboard
    file_put_contents("antrian.json", json_encode($data));

    echo json_encode($data);
    exit;
}

if($action == "reset"){

    file_put_contents($file,"0|0|-");

    echo json_encode([
        "loketA"=>0,
        "loketB"=>0,
        "last"=>"-"
    ]);

    exit;
}

echo json_encode([
    "nomor"=>$nomor,
    "loket"=>$loket
]);