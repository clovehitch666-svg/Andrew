<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
.logs-title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 25px;
}

.table-responsive {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,.1);
}

.pager-container {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.pager-container ul {
    display: flex;
    list-style: none;
    gap: 5px;
}

.pager-container a, .pager-container span {
    padding: 8px 12px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
    border-radius: 4px;
}

.pager-container .active span {
    background: #59c36a;
    color: white;
    border-color: #59c36a;
}
</style>

<div class="logs-title">
    Log Aktivitas Pengguna
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th style="width: 80px;">No</th>
                <th style="width: 180px;">Username</th>
                <th>Aktivitas / Tindakan</th>
                <th style="width: 200px;">Waktu Kejadian</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($logs)): ?>
                <tr>
                    <td colspan="4">Tidak ada data aktivitas.</td>
                </tr>
            <?php else: ?>
                <?php 
                $page = isset($_GET['page_logs']) ? (int)$_GET['page_logs'] : 1;
                $no = 1 + (($page - 1) * 25);
                foreach ($logs as $log): 
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= esc($log['username']) ?></strong></td>
                        <td style="text-align: left; padding-left: 20px;"><?= esc($log['action']) ?></td>
                        <td><?= esc($log['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pager-container">
        <?= $pager->links('logs', 'default_full') ?>
    </div>
</div>

<?= $this->endSection() ?>
