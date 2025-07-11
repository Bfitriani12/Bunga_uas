<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .stats-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .quick-action {
            text-decoration: none;
            color: inherit;
        }
        .quick-action:hover {
            color: inherit;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-home"></i> Sistem Manajemen Kos
                    </h1>
                    <p class="lead mb-4">
                        Kelola data penghuni, kamar, tagihan, dan pembayaran dengan mudah dan efisien
                    </p>
                    <div class="d-flex gap-3">
                        <a href="<?= base_url('penghuni') ?>" class="btn btn-light btn-lg">
                            <i class="fas fa-users"></i> Kelola Penghuni
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-building fa-6x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Penghuni</h6>
                                <h2 class="mb-0"><?= $stats['total'] ?></h2>
                            </div>
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Penghuni Aktif</h6>
                                <h2 class="mb-0"><?= $stats['active'] ?></h2>
                            </div>
                            <i class="fas fa-user-check fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stats-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Penghuni Keluar</h6>
                                <h2 class="mb-0"><?= $stats['inactive'] ?></h2>
                            </div>
                            <i class="fas fa-user-times fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center mb-4">
                    <i class="fas fa-cogs"></i> Modul Sistem
                </h2>
            </div>
            
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('penghuni') ?>" class="quick-action">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Data Penghuni</h5>
                            <p class="card-text">Kelola data penghuni kos, tambah, edit, dan hapus data penghuni</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('kamar') ?>" class="quick-action">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-bed fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Data Kamar</h5>
                            <p class="card-text">Kelola data kamar, harga sewa, dan status ketersediaan</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 mb-4">
                <a href="#" class="quick-action">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-file-invoice-dollar fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Tagihan</h5>
                            <p class="card-text">Kelola tagihan bulanan penghuni dan status pembayaran</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 mb-4">
                <a href="#" class="quick-action">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-bar fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Laporan</h5>
                            <p class="card-text">Lihat laporan keuangan, penghuni, dan statistik kos</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Penghuni -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clock"></i> Penghuni Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if(empty($recent_penghuni)): ?>
                            <p class="text-muted text-center">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                Belum ada data penghuni
                            </p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>No KTP</th>
                                            <th>No HP</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($recent_penghuni as $p): ?>
                                            <tr>
                                                <td><strong><?= $p->nama ?></strong></td>
                                                <td><?= $p->no_ktp ?></td>
                                                <td><?= $p->no_hp ?></td>
                                                <td><?= date('d/m/Y', strtotime($p->tgl_masuk)) ?></td>
                                                <td>
                                                    <?php if($p->tgl_keluar): ?>
                                                        <span class="badge bg-warning">Keluar</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-success">Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('penghuni/view/'.$p->id) ?>" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bolt"></i> Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <a href="<?= base_url('penghuni/add') ?>" class="btn btn-primary w-100">
                                    <i class="fas fa-plus"></i> Tambah Penghuni
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="<?= base_url('penghuni') ?>" class="btn btn-success w-100">
                                    <i class="fas fa-list"></i> Lihat Semua Penghuni
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="<?= base_url('test') ?>" class="btn btn-info w-100">
                                    <i class="fas fa-database"></i> Test Database
                                </a>
                            </div>
                            <div class="col-md-3 mb-2">
                                <a href="http://localhost/phpmyadmin" target="_blank" class="btn btn-warning w-100">
                                    <i class="fas fa-database"></i> phpMyAdmin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 