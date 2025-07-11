<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-stats {
            transition: transform 0.2s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        .btn-action {
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-users text-primary"></i> <?= $title ?>
                    </h1>
                    <a href="<?= base_url('penghuni/add') ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Penghuni
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-stats bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Total Penghuni</h5>
                                <h2 class="mb-0"><?= $stats['total'] ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Penghuni Aktif</h5>
                                <h2 class="mb-0"><?= $stats['active'] ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-user-check fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Penghuni Keluar</h5>
                                <h2 class="mb-0"><?= $stats['inactive'] ?></h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-user-times fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="<?= base_url('penghuni/search') ?>" method="GET" class="d-flex">
                    <input type="text" name="keyword" class="form-control me-2" placeholder="Cari nama, KTP, atau HP..." value="<?= isset($keyword) ? $keyword : '' ?>">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= base_url('penghuni') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-refresh"></i> Reset
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-table"></i> Daftar Penghuni
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($penghuni)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                        Tidak ada data penghuni
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($penghuni as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <strong><?= $p->nama ?></strong>
                                        </td>
                                        <td><?= $p->no_ktp ?></td>
                                        <td><?= $p->no_hp ?></td>
                                        <td><?= date('d/m/Y', strtotime($p->tgl_masuk)) ?></td>
                                        <td>
                                            <?php if($p->tgl_keluar): ?>
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-user-times"></i> Keluar
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-user-check"></i> Aktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('penghuni/view/'.$p->id) ?>" class="btn btn-sm btn-info btn-action" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('penghuni/edit/'.$p->id) ?>" class="btn btn-sm btn-warning btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('penghuni/delete/'.$p->id) ?>" class="btn btn-sm btn-danger btn-action" title="Hapus" 
                                               onclick="return confirm('Yakin ingin menghapus data ini?')">
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

        <!-- Back to Home -->
        <div class="row mt-4">
            <div class="col-12">
                <a href="<?= base_url() ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 