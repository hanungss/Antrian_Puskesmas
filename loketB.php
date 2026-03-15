<!DOCTYPE html>
<html>
<head>
<title>Loket B</title>
</head>
<body>

<h1>Loket B</h1>

<h2 id="nomor">0</h2>

<button onclick="next()">Panggil Berikutnya</button>
<button onclick="before()">Panggil Sebelumnyanya</button>
<button onclick="ulang()">Panggil Ulang</button>
<button class="reset" onclick="reset()">RESET ANTRIAN</button>

<script>

function load(){

fetch("api.php")
.then(r=>r.json())
.then(d=>{
document.getElementById("nomor").innerText=d.nomor
})

}

function next(){

fetch("api.php?action=next&loket=B")

}

function before(){

fetch("api.php?action=before&loket=A")

}

function ulang(){

fetch("api.php?action=repeat")

}

function reset(){

if(confirm("Reset semua antrian?")){

fetch("api.php?action=reset")

}

}

setInterval(load,1000)

</script>

</body>
</html>