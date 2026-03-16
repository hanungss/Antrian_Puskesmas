<?php
$nilai = 0; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Antrian Puskesmas Tamansari</title>
  <link rel="icon" type="image/png" href="https://puskesmastamansari.boyolali.go.id/files/setting/thumb/190_115-1773108375-Logo_Puskesmas_Tanpa_Background.png">
  
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f4f8; overflow: hidden; height: 100vh; }
    .app-root { display: flex; flex-direction: column; height: 100vh; }
    
    .header-bar { background: white; padding: 1rem 2rem; display: flex; align-items: center; border-bottom: 2px solid #e2e8f0; gap: 1.5rem; }
    .footer-bar { background: #0a5c36; color: white; padding: 0.5rem 2rem; display: flex; justify-content: space-between; font-size: 0.8rem; }
    
    /* Layout Baru: 2 Kolom (Video 70%, Antrian 30%) */
    .main-body { display: grid; grid-template-columns: 1fr 400px; flex: 1; gap: 1.5rem; padding: 1.5rem; overflow: hidden; }
    
    /* Video Section */
    .center-panel { display: flex; flex-direction: column; height: 100%; }
    .video-container { flex: 1; background: black; border-radius: 24px; overflow: hidden; position: relative; display: flex; flex-direction: column; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
    .video-header { background: #1e293b; color: white; padding: 1rem 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; }
    .video-iframe-wrap { flex: 1; position: relative; }
    .video-iframe-wrap iframe { position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; }

    /* Panel Kanan */
    .right-panel { display: flex; flex-direction: column; gap: 1.5rem; }
    .big-queue-card { background: white; padding: 3rem 1.5rem; border-radius: 24px; text-align: center; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border: 2px solid #e2e8f0; flex: 1; display: flex; flex-direction: column; justify-content: center; }
    .big-queue-card.highlight { border-color: #10b981; background: linear-gradient(to bottom, #ffffff, #f0fdf4); }
    .bq-num { font-size: 8rem; font-weight: 900; color: #059669; line-height: 1; margin: 1.5rem 0; }
    
    .ticker-bar { background: #ffedd5; padding: 0.75rem 2rem; border-bottom: 1px solid #fed7aa; }
  </style>
</head>

<body>
  <div class="app-root">
    <header class="header-bar">
      <div class="bg-green-50 p-2 rounded-full">
        <img src="https://puskesmastamansari.boyolali.go.id/files/setting/thumb/190_115-1773108375-Logo_Puskesmas_Tanpa_Background.png" alt="Logo Puskesmas" class="w-9 h-9 object-contain">
      </div>
      <div class="flex-1">
        <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Puskesmas Tamansari</h1>
        <p class="text-sm text-slate-500 font-medium italic">Jl Musuk Karanganyar KM6 Bendosari, RT.21 RW3, Karangkendal, Kecamatan Tamansari, Kabupaten Boyolali, Jawa Tengah 57361</p>
      </div>
      <div class="text-right">
        <div class="text-3xl font-bold text-slate-700" id="clock-time">00:00:00</div>
        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest" id="clock-date">-</div>
      </div>
    </header>

    <div class="ticker-bar">
      <div class="flex items-center gap-4">
        <span class="bg-orange-500 text-white px-3 py-1 rounded text-xs font-bold uppercase tracking-tighter">📢 Info</span>
        <marquee class="font-bold text-orange-800 text-lg">Selamat datang di Puskesmas Tamansari • Mohon menunggu antrian dengan tertib • Jaga Protokol Kesehatan dan Kebersihan Lingkungan • Selalu menjalankan Pola Hidup Bersih dan Sehat (PHBS)</marquee>
      </div>
    </div>

    <div class="main-body">
      <main class="center-panel">
        <div class="video-container">
          <div class="video-header text-lg">
            <span>Video Informasi dan Edukasi Kesehatan</span>
          </div>
          <div class="video-iframe-wrap">
            <iframe id="yt-player" 
              src="https://www.youtube.com/embed/jkS6glRPD_o?list=PLp4_ZpNRrQxoE1ylrekJSFm5KUG3KajdX&autoplay=1&mute=1&loop=1&playlist=jkS6glRPD_o" 
              allow="autoplay; encrypted-media; picture-in-picture" 
              allowfullscreen>
            </iframe>
          </div>
        </div>
      </main>

      <aside class="right-panel">
        <div class="big-queue-card highlight">
          <div class="font-bold tracking-widest uppercase">Nomor Antrian</div> 
          <div class="bq-num" id="nomor">0</div>
          <div class="pt-6 border-t border-slate-100 mt-4">
             <div class="text-lg font-bold text-slate-500 uppercase">Silahkan Menuju Loket</div>
             <div class="text-xl font-black uppercase text-slate-400 tracking-widest" id="loket">Loket...</div>
          </div>
        </div>
        
        <button onclick="enableAudio()" id="audio-btn" class="bg-slate-800 text-white p-5 rounded-2xl text-sm font-bold hover:bg-slate-700 transition shadow-lg">
          🔊 AKTIFKAN SUARA PANGGILAN
        </button>
      </aside>
    </div>

    <footer class="footer-bar">
      <span>Puskesmas Kecamatan Tamansari</span>
      <span class="font-bold tracking-widest uppercase">ANTRIAN PENDAFTARAN PASIEN PUSKESMAS TAMANSARI</span>
      <span>IT Puskesmas Tamansari 2026</span>
    </footer>
  </div>

  <script>
    let lastNomor = 0;
    let lastLoket = "";
    let audioEnabled = false;
    let lastPanggil = 0; // Tambahkan variabel pelacak baru

    function enableAudio() {
        audioEnabled = true;
        document.getElementById('audio-btn').innerHTML = "✅ SUARA AKTIF";
        document.getElementById('audio-btn').classList.replace('bg-slate-800', 'bg-green-600');
        setTimeout(() => { document.getElementById('audio-btn').style.opacity = '0.5'; }, 2000);
    }

    function updateClock() {
        const now = new Date();
        document.getElementById('clock-time').innerText = now.toLocaleTimeString('id-ID', { hour12: false });
        document.getElementById('clock-date').innerText = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }
    setInterval(updateClock, 1000);

    // function load(){
    //     fetch("api.php")
    //     .then(r=>r.json())
    //     .then(d=>{
    //         document.getElementById("nomor").innerText = d.nomor;
    //         document.getElementById("loket").innerText = "Loket " + d.loket;

    //         if(d.nomor != lastNomor || d.loket != lastLoket){
    //             if(audioEnabled) {
    //                 playAntrian(d.nomor);
    //             }
    //             lastNomor = d.nomor;
    //             lastLoket = d.loket;
    //         }
    //     }).catch(err => console.log("Menunggu API..."));
    // }

    // Ganti bagian script load() di index.php dengan ini:
function load(){
    // Membaca antrian.json (yang diupdate oleh tombol next, before, dan repeat)
    fetch("antrian.json") 
    .then(r=>r.json())
    .then(d=>{
        document.getElementById("nomor").innerText = d.nomor;
        document.getElementById("loket").innerText = "Loket " + d.loket;

        // Tambahkan pengecekan d.panggil agar mau bunyi saat nomor yang sama dipanggil ulang
        if(d.nomor != lastNomor || d.loket != lastLoket || d.panggil != lastPanggil){
            if(audioEnabled) {
                playAntrian(d.nomor);
            }
            lastNomor = d.nomor;
            lastLoket = d.loket;
            lastPanggil = d.panggil; // Update tracker timestamp
        }
    }).catch(err => console.log("Menunggu data antrian..."));
}

   

    function numberToAudioSequence(n) {
        const suara = [];
        suara.push('panggilan.mp3');
        if (n === 0) return suara;
        suara.push('nomorantrian.mp3');
        const map = ["kosong","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas"];
        function playTwoDigits(num) {
            const result = [];
            if (num === 0) return [];
            if (num <= 11) { result.push(map[num] + ".mp3"); }
            else if (num < 20) { result.push(map[num - 10] + ".mp3"); result.push("belas.mp3"); }
            else {
                const puluh = Math.floor(num / 10);
                const satuan = num % 10;
                if (puluh === 1) { result.push("sepuluh.mp3"); }
                else { result.push(map[puluh] + ".mp3"); }
                result.push("puluh.mp3");
                if (satuan > 0) { result.push(map[satuan] + ".mp3"); }
            }
            return result;
        }
        if (n > 0) {
            const ribu = Math.floor(n / 1000);
            const ratus = Math.floor((n % 1000) / 100);
            const sisa = n % 100;
            if (ribu > 0) {
                if (ribu === 1) { suara.push("seribu.mp3"); }
                else { suara.push(map[ribu] + ".mp3"); suara.push("ribu.mp3"); }
            }
            if (ratus > 0) {
                if (ratus === 1) { suara.push("seratus.mp3"); }
                else { suara.push(map[ratus] + ".mp3"); suara.push("ratus.mp3"); }
            }
            suara.push(...playTwoDigits(sisa));
            suara.push("menujuloket.mp3");
        }
        return suara;
    }

    function playAudioQueue(files, index=0){
        if(index >= files.length) return;
        const audio = new Audio('suara/' + files[index]);
        audio.onended = () => playAudioQueue(files, index + 1);
        audio.play().catch(e => console.log("Audio play blocked"));
    }

    function playAntrian(n){
        const files = numberToAudioSequence(n);
        playAudioQueue(files);
    }

    setInterval(load, 1000);
    updateClock();
  </script>
</body>
</html>