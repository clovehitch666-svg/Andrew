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

        <?php if (session()->get('role') === 'admin'): ?>
        <a href="/expired">
            📅 Laporan Expired
        </a>
        <a href="/logactivity">
            📜 Log Activity
        </a>
        <?php endif; ?>

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

        <span>🔔</span>
        <span>💬</span>

    </div>

</div>

<div class="content">

    <?= $this->renderSection('content') ?>

</div>

</body>
</html>