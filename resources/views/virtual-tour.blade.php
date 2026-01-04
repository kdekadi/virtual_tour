<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Virtual Tour</title>

<style>
body {
    margin: 0;
    background: #000;
    font-family: Arial, sans-serif;
    overflow: hidden;
}

.vt-container {
    position: relative;
    width: 100vw;
    height: 100vh;
}

/* ===== IFRAME (HARUS AKTIF) ===== */
.vt-iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* ===== CONTROLS ===== */
.vt-controls {
    position: absolute;
    bottom: 20px;
    right: 20px;
    z-index: 50;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.vt-controls button {
    background: #a3d586;
    color: #000;
    border: none;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 16px;
    cursor: pointer;
}

.guide-btn {
    background: #f11602;
    color: #fff;
    font-weight: bold;
}

/* ===== GUIDE PANEL KECIL ===== */
.vt-guide {
    position: absolute;
    bottom: 160px;
    right: 20px;
    width: 280px;
    background: rgba(0,0,0,.88);
    color: #fff;
    border-radius: 12px;
    z-index: 60;
    display: none;
}

.vt-guide-header {
    padding: 12px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255,255,255,.2);
}

.vt-guide ul {
    list-style: none;
    padding: 12px;
    margin: 0;
}

.vt-guide li {
    font-size: 14px;
    margin-bottom: 8px;
}

/* ===== FULLSCREEN GUIDE ===== */
.guide-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.9);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.guide-box {
    background: #111;
    color: #fff;
    width: 90%;
    max-width: 380px;
    border-radius: 16px;
    overflow: hidden;
}

.guide-header {
    padding: 14px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    background: #000;
}

.guide-list {
    list-style: none;
    padding: 16px;
    margin: 0;
}

.guide-list li {
    font-size: 14px;
    margin-bottom: 10px;
}

.guide-start {
    width: 100%;
    padding: 14px;
    border: none;
    background: #a3d586;
    font-weight: bold;
    cursor: pointer;
}
</style>
</head>

<body>

<!-- ===== INFO + GUIDE (MUNCUL DI AWAL) ===== -->
<div id="guideOverlay" class="guide-overlay">
    <div class="guide-box">
        <div class="guide-header">
            Informasi & Panduan
            <span onclick="closeGuide()">✕</span>
        </div>

        <ul class="guide-list">
            <li><b>Bukit Trunyan</b></li>
            <li>Jalur alami dengan pepohonan rindang</li>
            <li>Geser layar untuk melihat sekitar</li>
            <hr>
            <li>❯ Panorama berikutnya</li>
            <li>❮❮❮ Panorama sebelumnya</li>
            <li>ℹ Informasi lokasi</li>
            <li>⬆ Langsung ke Puncak</li>
            <li>⬇ Kembali ke awal</li>
            <li>＋ / − Perbesar & perkecil</li>
            <li>⛶ Mode layar penuh</li>
            <li>✕ Menutup info (tombol bawaan 3Sixty)</li>
        </ul>

        <button class="guide-start" onclick="minimizeGuide()">
            Masuk Virtual Tour
        </button>
    </div>
</div>

<div class="vt-container" id="vtContainer">

    <!-- GUIDE KECIL -->
    <div id="vtGuide" class="vt-guide">
        <div class="vt-guide-header">
            Info & Panduan
            <span onclick="closeGuide()">✕</span>
        </div>
        <ul>
           <li><b>Bukit Trunyan</b></li>
            <li>Jalur alami dengan pepohonan rindang</li>
            <li>Geser layar untuk melihat sekitar</li>
            <hr>
            <li>❯ Panorama berikutnya</li>
            <li>❮❮❮ Panorama sebelumnya</li>
            <li>ℹ Informasi lokasi</li>
            <li>⬆ Langsung ke Puncak</li>
            <li>⬇ Kembali ke awal</li>
            <li>＋ / − Perbesar & perkecil</li>
            <li>⛶ Mode layar penuh</li>
            <li>✕ Menutup info (tombol bawaan 3Sixty)</li>
        </ul>
    </div>

    <!-- CONTROLS -->
    <div class="vt-controls">
        <button class="guide-btn" onclick="toggleGuide()">☰</button>
        <button onclick="zoomIn()">＋</button>
        <button onclick="zoomOut()">－</button>
        <button onclick="toggleFullscreen()">⛶</button>
    </div>

    <!-- PANORAMA -->
    <iframe id="vtFrame" class="vt-iframe"
        src="{{ asset('VirtualTour/index.html') }}">
    </iframe>

</div>

<script>
let scale = 1;
const frame = document.getElementById('vtFrame');
const container = document.getElementById('vtContainer');

function zoomIn() {
    scale += 0.1;
    frame.style.transform = `scale(${scale})`;
}

function zoomOut() {
    if (scale > 0.6) {
        scale -= 0.1;
        frame.style.transform = `scale(${scale})`;
    }
}

function toggleFullscreen() {
    if (!document.fullscreenElement) {
        container.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
}

function toggleGuide() {
    const g = document.getElementById('vtGuide');
    g.style.display = g.style.display === 'block' ? 'none' : 'block';
}

function minimizeGuide() {
    document.getElementById('guideOverlay').style.display = 'none';
}

function closeGuide() {
    document.getElementById('guideOverlay').style.display = 'none';
    document.getElementById('vtGuide').style.display = 'none';
}
</script>

</body>
</html>
