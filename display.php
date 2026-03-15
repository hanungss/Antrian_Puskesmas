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
}

.loket{
font-size:80px;
}

</style>

</head>

<body>

<h1>ANTRIAN</h1>

<div class="nomor" id="nomor">0</div>
<div class="loket" id="loket">-</div>

<script>

let lastNomor=0
let lastLoket=""

function load(){

fetch("api.php")
.then(r=>r.json())
.then(d=>{

document.getElementById("nomor").innerText=d.nomor
document.getElementById("loket").innerText="Loket "+d.loket

if(d.nomor!=lastNomor || d.loket!=lastLoket){

playAudio(d.nomor,d.loket)

lastNomor=d.nomor
lastLoket=d.loket

}

})

}

function playAudio(n,l){

let files=[]

files.push("panggilan.mp3")
files.push("nomorantrian.mp3")

let angka=n.toString().split("")

angka.forEach(a=>{
files.push(a+".mp3")
})

files.push("menujuloket.mp3")
files.push("loket"+l.toLowerCase()+".mp3")

playQueue(files)

}

function playQueue(list,i=0){

if(i>=list.length)return

let audio=new Audio("suara/"+list[i])

audio.onended=()=>playQueue(list,i+1)

audio.play()

}

setInterval(load,1000)

</script>

</body>
</html>