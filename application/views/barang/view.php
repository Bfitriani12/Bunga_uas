<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .detail-container { max-width: 600px; margin: 0 auto; }
        .card { border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; }
        .info-item { padding: 10px 0; border-bottom: 1px solid #eee; }
        .info-item:last-child { border-bottom: none; }
        .info-label { font-weight: bold; color: #495057; }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="detail-container">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-box text-primary"></i> <?= $title ?>
                    </h1>
                    <a href="<?= base_url('barang') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Detail Barang/Alat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-box"></i> Nama Barang/Alat</div>
                        <div class="mt-1"><strong><?= $barang->nama ?></strong></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-money-bill-wave"></i> Biaya Tambahan</div>
                        <div class="mt-1">Rp <?= number_format($barang->harga, 0, ',', '.') ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-database"></i> ID Barang</div>
                        <div class="mt-1"><code>#<?= str_pad($barang->id, 3, '0', STR_PAD_LEFT) ?></code></div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-between">
                    <div>
                        <a href="<?= base_url('barang/edit/'.$barang->id) ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        <a href="<?= base_url('barang/delete/'.$barang->id) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </div>
                    <div>
                        <a href="<?= base_url('barang') ?>" class="btn btn-secondary">
                            <i class="fas fa-list"></i> Daftar Barang
                        </a>
                        <a href="<?= base_url() ?>" class="btn btn-primary">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 