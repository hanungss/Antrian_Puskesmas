<?php
$nilai = 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>Display Antrian</title>

<style>

body{
text-align:center;
font-family:Arial;
background:#111;
color:white;
}

.nomor{
font-size:200px;
font-weight:bold;
}

.loket{
font-size:80px;
margin-top:20px;
}

</style>

</head>

<body>

<h1>ANTRIAN</h1>

<div class="nomor" id="nomor">0</div>
<div class="loket" id="loket">-</div>

<script>

let lastNomor = 0
let lastLoket = ""

function load(){

fetch("api.php")
.then(r=>r.json())
.then(d=>{

document.getElementById("nomor").innerText = d.nomor
document.getElementById("loket").innerText = "Loket " + d.loket

if(d.nomor != lastNomor || d.loket != lastLoket){

playAntrian(d.nomor)

lastNomor = d.nomor
lastLoket = d.loket

}

})

}



function numberToAudioSequence(n) {

const suara = []
suara.push('panggilan.mp3')

if (n === 0) {
return suara
}

suara.push('nomorantrian.mp3')

const map = ["kosong","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas"]

function playTwoDigits(num) {

const result = []

if (num === 0) return []

if (num <= 11) {

result.push(map[num] + ".mp3")

}

else if (num < 20) {

result.push(map[num - 10] + ".mp3")
result.push("belas.mp3")

}

else {

const puluh = Math.floor(num / 10)
const satuan = num % 10

if (puluh === 1) {
result.push("sepuluh.mp3")
}
else {
result.push(map[puluh] + ".mp3")
}

result.push("puluh.mp3")

if (satuan > 0) {
result.push(map[satuan] + ".mp3")
}

}

return result

}



if (n > 0) {

const ribu = Math.floor(n / 1000)
const ratus = Math.floor((n % 1000) / 100)
const sisa = n % 100

if (ribu > 0) {

if (ribu === 1) {
suara.push("seribu.mp3")
}
else {
suara.push(map[ribu] + ".mp3")
suara.push("ribu.mp3")
}

}

if (ratus > 0) {

if (ratus === 1) {
suara.push("seratus.mp3")
}
else {
suara.push(map[ratus] + ".mp3")
suara.push("ratus.mp3")
}

}

suara.push(...playTwoDigits(sisa))

suara.push("menujuloket.mp3")

}

return suara

}



function playAudioQueue(files,index=0){

if(index>=files.length)return

const audio=new Audio('suara/'+files[index])

audio.onended=()=>playAudioQueue(files,index+1)

audio.play()

}



function playAntrian(n){

const files = numberToAudioSequence(n)

playAudioQueue(files)

}



setInterval(load,1000)

</script>

</body>
</html>