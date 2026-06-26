<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Apotek Baraya</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#e5e5e5;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:250px;
    height:100vh;
    background:#59c36a;
    position:fixed;
    top:0;
    left:0;
    overflow-y:auto;
}

.sidebar-title{
    text-align:center;
    color:white;
    font-size:24px;
    font-weight:bold;
    padding:20px;
    border-bottom:1px solid rgba(255,255,255,.3);
}

.menu{
    padding:15px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:10px;
    background:#d9d9d9;
    padding:12px 15px;
    margin-bottom:10px;
    text-decoration:none;
    color:black;
    font-weight:bold;
    border-radius:4px;
}

.menu a:hover{
    background:white;
}

/* ================= HEADER ================= */

.header{
    margin-left:250px;
    height:85px;
    background:#cfcfcf;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
}

.header-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.header-left img{
    width:60px;
    height:60px;
    object-fit:contain;
}

.header-left h1{
    font-size:32px;
    font-weight:800;
}

.header-right{
    display:flex;
    gap:30px;
    font-size:30px;
}

/* ================= CONTENT ================= */

.content{
    margin-left:250px;
    padding:25px;
}

/* ================= DASHBOARD ================= */

.dashboard-title{
    font-size:30px;
    font-weight:bold;
    margin-bottom:25px;
}

.card-container{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

.card{
    flex:1;
    min-width:250px;
    min-height:150px;
    color:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,.2);
}

.card span{
    display:block;
    font-size:48px;
    font-weight:bold;
    margin-bottom:10px;
}

.card h2{
    font-size:24px;
}

.blue{
    background:#1f76be;
}

.red{
    background:#ef233c;
}

.green{
    background:#59c36a;
}

.cyan{
    background:#4fb6b8;
}

.purple{
    background:#8a7ddc;
}

.welcome-box{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 3px 8px rgba(0,0,0,.1);
}

/* ================= TABLE ================= */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th{
    background:#d9dde1;
    border:1px solid #555;
    text-align:center;
    padding:12px;
}

table td{
    border:1px solid #555;
    text-align:center;
    padding:12px;
}

/* ================= FORM ================= */

input,
select,
textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
}

button{
    padding:10px 20px;
    border:none;
    background:#59c36a;
    color:white;
    cursor:pointer;
    border-radius:4px;
}

button:hover{
    background:#48a958;
}

/* ================= BUTTON ================= */

.btn{
    background:#59c36a;
    color:white;
    text-decoration:none;
    padding:8px 14px;
    border-radius:4px;
}

.btn:hover{
    opacity:.9;
}

/* ================= ALERT ================= */

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:5px;
    margin-bottom:15px;
}

/* ================= NOTIFICATION ================= */

.notification-container {
    position: relative;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -10px;
    background: #ef233c;
    color: white;
    font-size: 11px;
    font-weight: bold;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #cfcfcf;
}

.notification-dropdown {
    position: absolute;
    top: 45px;
    right: 0;
    width: 320px;
    max-height: 400px;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    z-index: 1000;
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.notification-dropdown.active {
    display: flex;
}

.dropdown-header {
    background: #59c36a;
    color: white;
    padding: 12px 16px;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.dropdown-body {
    overflow-y: auto;
    flex: 1;
}

.notification-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    flex-direction: column;
    gap: 4px;
    text-decoration: none;
    color: inherit;
    text-align: left;
    line-height: 1.4;
}

.notification-item:hover {
    background: #f8faf9;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item-title {
    font-size: 13px;
    font-weight: bold;
    color: #2b2b2b;
}

.notification-item-desc {
    font-size: 12px;
    color: #ef233c;
    font-weight: 500;
}

.notification-item-meta {
    font-size: 11px;
    color: #888;
}

.dropdown-empty {
    padding: 30px;
    text-align: center;
    color: #888;
    font-size: 13px;
}

.dropdown-footer {
    padding: 10px;
    text-align: center;
    border-top: 1px solid #f0f0f0;
    background: #fafafa;
}

.dropdown-footer a {
    font-size: 12px;
    color: #59c36a;
    text-decoration: none;
    font-weight: bold;
}

.dropdown-footer a:hover {
    text-decoration: underline;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

.sidebar{
    width:100%;
    height:auto;
    position:relative;
}

.header{
    margin-left:0;
}

.content{
    margin-left:0;
}

}

</style>

</head>

<body>

<div class="sidebar">

    <div class="sidebar-title">
        🏥 APOTEK BARAYA
    </div>

    <div class="menu">

        <a href="/dashboard">
            🏠 Dashboard
        </a>

        <a href="/obat">
            💊 Tabel Master Obat
        </a>

        <a href="/stokopname">
            📦 Stok Opname
        </a>

        <a href="/fefo">
            👜 FEFO
        </a>

        <a href="/rekap">
            📋 Rekap Stok
        </a>

        <a href="/laporan">
            📖 Laporan
        </a>

        <a href="/expired">
            📅 Laporan Expired
        </a>

        <?php if (session()->get('role') === 'admin'): ?>
        <a href="/pengguna">
            👥 Kelola Pengguna
        </a>
        <a href="/logactivity">
            📜 Log Activity
        </a>
        <?php endif; ?>

        <a href="/profil">
            👤 Profil Saya
        </a>

        <a href="/logout">
            🚪 Logout
        </a>

    </div>

</div>

<div class="header">

    <div class="header-left">

        <img src="/images/logo.png" alt="Logo">

        <h1>APOTEK BARAYA</h1>

    </div>

    <div class="header-right">

        <div class="notification-container" id="notifContainer">
            <span style="font-size: 30px; line-height: 1;">🔔</span>
            <span class="notification-badge" id="notifBadge" style="display: none;">0</span>
            <div class="notification-dropdown" id="notifDropdown">
                <div class="dropdown-header">
                    <span>Notifikasi</span>
                    <span id="notifCountText" style="font-size: 12px; font-weight: normal; background: rgba(0,0,0,0.15); padding: 2px 8px; border-radius: 10px;">0 Obat</span>
                </div>
                <div class="dropdown-body" id="notifList">
                    <div class="dropdown-empty">Memuat...</div>
                </div>
                <div class="dropdown-footer">
                    <a href="/expired">Lihat Semua Laporan Expired</a>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="content">

    <?= $this->renderSection('content') ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const notifContainer = document.getElementById('notifContainer');
    const notifBadge = document.getElementById('notifBadge');
    const notifDropdown = document.getElementById('notifDropdown');
    const notifCountText = document.getElementById('notifCountText');
    const notifList = document.getElementById('notifList');

    // Fetch notifications
    function fetchNotifications() {
        fetch('/api/notifications')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(res => {
                if (res.status === 'success') {
                    const count = res.count;
                    notifCountText.textContent = `${count} Obat`;
                    
                    if (count > 0) {
                        notifBadge.textContent = count;
                        notifBadge.style.display = 'flex';
                        
                        let html = '';
                        res.data.forEach(item => {
                            const expDate = new Date(item.expired_date);
                            const formattedDate = expDate.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                            
                            html += `
                                <a href="/expired" class="notification-item">
                                    <div class="notification-item-title">💊 ${item.nama_obat}</div>
                                    <div class="notification-item-desc">Sudah Kadaluarsa! (${formattedDate})</div>
                                    <div class="notification-item-meta">Stok: ${item.stok} ${item.satuan || ''} | Batch: ${item.no_batch || '-'}</div>
                                </a>
                            `;
                        });
                        notifList.innerHTML = html;
                    } else {
                        notifBadge.style.display = 'none';
                        notifList.innerHTML = '<div class="dropdown-empty">Tidak ada obat kadaluarsa 🎉</div>';
                    }
                }
            })
            .catch(err => {
                console.error('Error fetching notifications:', err);
                notifList.innerHTML = '<div class="dropdown-empty" style="color: #ef233c;">Gagal memuat notifikasi</div>';
            });
    }

    // Load on init
    fetchNotifications();

    // Toggle dropdown
    notifContainer.addEventListener('click', function(e) {
        e.stopPropagation();
        notifDropdown.classList.toggle('active');
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
        if (!notifContainer.contains(e.target)) {
            notifDropdown.classList.remove('active');
        }
    });
});
</script>

</body>
</html>