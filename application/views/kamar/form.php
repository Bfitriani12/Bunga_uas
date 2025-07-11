<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-container { max-width: 600px; margin: 0 auto; }
        .card { border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="form-container">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-bed text-primary"></i> <?= $title ?>
                    </h1>
                    <a href="<?= base_url('kamar') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit"></i> Form Data Kamar
                    </h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nomor" class="form-label">
                                <i class="fas fa-door-closed"></i> Nomor Kamar <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control <?= form_error('nomor') ? 'is-invalid' : '' ?>" id="nomor" name="nomor" value="<?= set_value('nomor', isset($kamar) ? $kamar->nomor : '') ?>" placeholder="Masukkan nomor kamar">
                            <?= form_error('nomor', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">
                                <i class="fas fa-money-bill-wave"></i> Harga Sewa (per bulan) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control <?= form_error('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= set_value('harga', isset($kamar) ? $kamar->harga : '') ?>" placeholder="Masukkan harga sewa">
                            <?= form_error('harga', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle"></i> Status
                            </label>
                            <select class="form-select" id="status" name="status">
                                <option value="tersedia" <?= set_select('status', 'tersedia', isset($kamar) && $kamar->status == 'tersedia') ?>>Tersedia</option>
                                <option value="terisi" <?= set_select('status', 'terisi', isset($kamar) && $kamar->status == 'terisi') ?>>Terisi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-boxes"></i> Barang/Alat di Kamar
                            </label>
                            <div class="row">
                                <?php foreach($all_barang as $b): ?>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="barang[]" value="<?= $b->id ?>" id="barang<?= $b->id ?>" <?= (isset($barang_kamar) && in_array($b->id, $barang_kamar)) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="barang<?= $b->id ?>">
                                            <?= $b->nama ?> <span class="badge bg-info">Rp <?= number_format($b->harga,0,',','.') ?></span>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= base_url('kamar') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <?= isset($kamar) ? 'Update Data' : 'Simpan Data' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Nomor kamar harus unik dan wajib diisi</li>
                        <li>Harga sewa wajib diisi dan berupa angka</li>
                        <li>Status "terisi" hanya untuk kamar yang sudah ditempati</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 