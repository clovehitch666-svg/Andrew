<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Expired - Apotek Baraya</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: white;
            color: black;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }
        .meta-info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }
        table th {
            background-color: #f2f2f2;
        }
        .signature {
            float: right;
            text-align: center;
            margin-top: 40px;
            width: 200px;
        }
        .signature p {
            margin: 0;
        }
        .signature-space {
            height: 70px;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #59c36a; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">🖨️ Cetak / Simpan PDF</button>
    </div>

    <div class="header">
        <h1>APOTEK BARAYA</h1>
        <p>Laporan Persediaan Barang Kedaluwarsa (Expired)</p>
    </div>

    <div class="meta-info">
        <strong>Periode Laporan:</strong> 
        <?php if ($start_date && $end_date): ?>
            <?= esc($start_date) ?> s/d <?= esc($end_date) ?>
        <?php else: ?>
            Semua data expired s/d hari ini (<?= date('d-m-Y') ?>)
        <?php endif; ?>
        <br>
        <strong>Dicetak pada:</strong> <?= date('d-m-Y H:i') ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>No Batch</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Tanggal Expired</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($obat)): ?>
                <tr>
                    <td colspan="7">Tidak ada data.</td>
                </tr>
            <?php else: ?>
                <?php 
                $no = 1;
                foreach ($obat as $o): 
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($o['no_batch'] ?: '-') ?></td>
                        <td style="text-align: left;"><strong><?= esc($o['nama_obat']) ?></strong></td>
                        <td><?= esc($o['kategori']) ?></td>
                        <td><?= esc($o['stok']) ?></td>
                        <td><?= esc($o['satuan']) ?></td>
                        <td><?= esc($o['expired_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature">
        <p>Tasikmalaya, <?= date('d-m-Y') ?></p>
        <p>Apoteker Penanggung Jawab,</p>
        <div class="signature-space"></div>
        <p><strong>( ____________________ )</strong></p>
    </div>

    <script>
        // Otomatis trigger dialog print saat halaman dimuat
        window.addEventListener('DOMContentLoaded', () => {
            // Beri jeda sedikit agar halaman ter-render sempurna
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
