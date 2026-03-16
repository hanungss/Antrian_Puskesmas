<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Operator - Loket A</title>
    <link rel="icon" type="image/png" href="https://puskesmastamansari.boyolali.go.id/files/setting/thumb/190_115-1773108375-Logo_Puskesmas_Tanpa_Background.png">
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .btn-action { transition: all 0.2s ease; }
        .btn-action:active { transform: scale(0.95); }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full glass-card rounded-[2rem] shadow-2xl border border-white p-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800">LOKET A Pendaftaran Pasien</h1>
                <p class="text-sm text-slate-500 font-medium">Puskesmas Tamansari</p>
            </div>
            <div class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider animate-pulse">
                ● Online
            </div>
        </div>

        <div class="bg-slate-900 rounded-3xl p-10 text-center mb-8 shadow-inner relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-green-500"></div>
            <span class="text-slate-500 text-xs font-bold uppercase tracking-[0.3em]">Antrian Sekarang</span>
            <h2 id="nomor" class="text-8xl font-black text-white mt-2 mb-2">0</h2>
            <div class="flex justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-slate-700"></span>
                <span class="w-2 h-2 rounded-full bg-slate-700"></span>
                <span class="w-2 h-2 rounded-full bg-slate-700"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <button onclick="next()" class="btn-action bg-green-600 hover:bg-green-700 text-white rounded-2xl py-5 px-6 flex items-center justify-between shadow-lg shadow-green-200">
                <div class="flex items-center gap-3">
                    <i data-lucide="user-plus" class="w-6 h-6"></i>
                    <span class="font-bold text-lg">Panggil Berikutnya</span>
                </div>
                <i data-lucide="chevron-right" class="w-5 h-5 opacity-50"></i>
            </button>

            <div class="grid grid-cols-2 gap-4">
                <button onclick="ulang()" class="btn-action bg-blue-500 hover:bg-blue-600 text-white rounded-2xl py-4 px-4 flex items-center justify-center gap-2 shadow-md shadow-blue-100">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                    <span class="font-bold">Ulang</span>
                </button>
                <button onclick="before()" class="btn-action bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-2xl py-4 px-4 flex items-center justify-center gap-2">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    <span class="font-bold">Sebelumnya</span>
                </button>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-slate-100">
            <button onclick="reset()" class="btn-action w-full flex items-center justify-center gap-2 text-slate-400 hover:text-red-500 transition-colors text-xs font-bold uppercase tracking-widest">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                Reset Antrian Hari Ini
            </button>
        </div>
    </div>

    <script>
        // Inisialisasi Ikon Lucide
        lucide.createIcons();

        function load() {
            fetch("api.php")
                .then(r => r.json())
                .then(d => {
                    const el = document.getElementById("nomor");
                    // Efek transisi angka sederhana
                    if(el.innerText != d.nomor) {
                        el.style.opacity = 0;
                        setTimeout(() => {
                            el.innerText = d.nomor;
                            el.style.opacity = 1;
                        }, 200);
                    }
                })
        }

        function next() {
            fetch("api.php?action=next&loket=A")
                .then(() => { load(); });
        }

        function before() {
            fetch("api.php?action=before&loket=A")
                .then(() => { load(); });
        }

        function ulang() {
    // Mengirim perintah repeat ke API
    fetch("api.php?action=repeat&loket=A")
    .then(r => r.json())
    .then(d => {
        console.log("Mengulang panggilan nomor: " + d.nomor);
    });
}

        function reset() {
            if (confirm("Reset semua antrian? Tindakan ini tidak bisa dibatalkan.")) {
                fetch("api.php?action=reset").then(() => { load(); });
            }
        }

        setInterval(load, 1000);
        load(); // Load pertama kali
    </script>
</body>
</html>