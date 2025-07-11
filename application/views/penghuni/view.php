<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .detail-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }
        .info-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
        }
        .status-badge {
            font-size: 0.9rem;
            padding: 8px 12px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="detail-container">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0">
                            <i class="fas fa-user text-primary"></i> <?= $title ?>
                        </h1>
                        <div>
                            <a href="<?= base_url('penghuni/edit/'.$penghuni->id) ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('penghuni') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Detail Informasi Penghuni
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user"></i> Nama Lengkap
                                </div>
                                <div class="mt-1">
                                    <strong><?= $penghuni->nama ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-id-card"></i> No KTP
                                </div>
                                <div class="mt-1">
                                    <code><?= $penghuni->no_ktp ?></code>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-phone"></i> No HP
                                </div>
                                <div class="mt-1">
                                    <a href="tel:<?= $penghuni->no_hp ?>" class="text-decoration-none">
                                        <?= $penghuni->no_hp ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar"></i> Tanggal Masuk
                                </div>
                                <div class="mt-1">
                                    <?= date('d F Y', strtotime($penghuni->tgl_masuk)) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-times"></i> Tanggal Keluar
                                </div>
                                <div class="mt-1">
                                    <?php if($penghuni->tgl_keluar): ?>
                                        <?= date('d F Y', strtotime($penghuni->tgl_keluar)) ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-clock"></i> Status
                                </div>
                                <div class="mt-1">
                                    <?php if($penghuni->tgl_keluar): ?>
                                        <span class="badge bg-warning status-badge">
                                            <i class="fas fa-user-times"></i> Keluar
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success status-badge">
                                            <i class="fas fa-user-check"></i> Aktif
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt"></i> Lama Tinggal
                                </div>
                                <div class="mt-1">
                                    <?php
                                    $tgl_masuk = new DateTime($penghuni->tgl_masuk);
                                    $tgl_sekarang = new DateTime();
                                    if($penghuni->tgl_keluar) {
                                        $tgl_sekarang = new DateTime($penghuni->tgl_keluar);
                                    }
                                    $selisih = $tgl_masuk->diff($tgl_sekarang);
                                    echo $selisih->y . ' tahun, ' . $selisih->m . ' bulan, ' . $selisih->d . ' hari';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-database"></i> ID Penghuni
                                </div>
                                <div class="mt-1">
                                    <code>#<?= str_pad($penghuni->id, 4, '0', STR_PAD_LEFT) ?></code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('penghuni/edit/'.$penghuni->id) ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                            <a href="<?= base_url('penghuni/delete/'.$penghuni->id) ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus data penghuni ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                        <div>
                            <a href="<?= base_url('penghuni') ?>" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Daftar Penghuni
                            </a>
                            <a href="<?= base_url() ?>" class="btn btn-primary">
                                <i class="fas fa-home"></i> Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Informasi Tambahan
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Data penghuni ini dapat diubah melalui tombol "Edit Data"</li>
                        <li>Penghuni yang sudah keluar akan ditandai dengan status "Keluar"</li>
                        <li>Lama tinggal dihitung dari tanggal masuk hingga sekarang atau tanggal keluar</li>
                        <li>No HP dapat diklik untuk melakukan panggilan langsung</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 