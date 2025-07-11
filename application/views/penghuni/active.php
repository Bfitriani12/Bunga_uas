<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .table-responsive { border-radius: 8px; overflow: hidden; }
        .btn-action { margin: 2px; }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-user-check text-success"></i> <?= $title ?>
                </h1>
                <a href="<?= base_url('penghuni') ?>" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Semua Penghuni
                </a>
            </div>
        </div>

        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Penghuni Aktif</h5>
                        <h2 class="mb-0"><?= $stats['active'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Penghuni</h5>
                        <h2 class="mb-0"><?= $stats['total'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Penghuni Keluar</h5>
                        <h2 class="mb-0"><?= $stats['inactive'] ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Penghuni Aktif -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-table"></i> Daftar Penghuni Aktif
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No KTP</th>
                                <th>No HP</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($penghuni)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        Tidak ada penghuni aktif
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($penghuni as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><strong><?= $p->nama ?></strong></td>
                                        <td><?= $p->no_ktp ?></td>
                                        <td><?= $p->no_hp ?></td>
                                        <td><?= date('d/m/Y', strtotime($p->tgl_masuk)) ?></td>
                                        <td>
                                            <a href="<?= base_url('penghuni/view/'.$p->id) ?>" class="btn btn-sm btn-info btn-action" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('penghuni/edit/'.$p->id) ?>" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('penghuni/delete/'.$p->id) ?>" class="btn btn-sm btn-danger btn-action" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <a href="<?= base_url() ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 