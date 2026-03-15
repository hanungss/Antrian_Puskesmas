<?php

$file = "antrian.txt";

if(!file_exists($file)){
    file_put_contents($file,"0|-");
}

$data = file_get_contents($file);
list($nomor,$loket) = explode("|",$data);

$action = $_GET['action'] ?? '';

if($action == "next"){

    $loket = $_GET['loket'];

    $nomor = (int)$nomor + 1;

    file_put_contents($file,$nomor."|".$loket);

    echo json_encode([
        "nomor"=>$nomor,
        "loket"=>$loket
    ]);

    exit;
}

if($action == "repeat"){

    echo json_encode([
        "nomor"=>$nomor,
        "loket"=>$loket
    ]);

    exit;
}

echo json_encode([
    "nomor"=>$nomor,
    "loket"=>$loket
]);