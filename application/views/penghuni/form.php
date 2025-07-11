<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Kos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="form-container">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0">
                            <i class="fas fa-user-plus text-primary"></i> <?= $title ?>
                        </h1>
                        <a href="<?= base_url('penghuni') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit"></i> Form Data Penghuni
                    </h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user"></i> Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" 
                                           id="nama" name="nama" value="<?= set_value('nama', isset($penghuni) ? $penghuni->nama : '') ?>" 
                                           placeholder="Masukkan nama lengkap">
                                    <?= form_error('nama', '<div class="invalid-feedback">', '</div>') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_ktp" class="form-label">
                                        <i class="fas fa-id-card"></i> No KTP <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control <?= form_error('no_ktp') ? 'is-invalid' : '' ?>" 
                                           id="no_ktp" name="no_ktp" value="<?= set_value('no_ktp', isset($penghuni) ? $penghuni->no_ktp : '') ?>" 
                                           placeholder="Masukkan nomor KTP">
                                    <?= form_error('no_ktp', '<div class="invalid-feedback">', '</div>') ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">
                                        <i class="fas fa-phone"></i> No HP <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" 
                                           id="no_hp" name="no_hp" value="<?= set_value('no_hp', isset($penghuni) ? $penghuni->no_hp : '') ?>" 
                                           placeholder="Masukkan nomor HP">
                                    <?= form_error('no_hp', '<div class="invalid-feedback">', '</div>') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_masuk" class="form-label">
                                        <i class="fas fa-calendar"></i> Tanggal Masuk <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control <?= form_error('tgl_masuk') ? 'is-invalid' : '' ?>" 
                                           id="tgl_masuk" name="tgl_masuk" value="<?= set_value('tgl_masuk', isset($penghuni) ? $penghuni->tgl_masuk : '') ?>">
                                    <?= form_error('tgl_masuk', '<div class="invalid-feedback">', '</div>') ?>
                                </div>
                            </div>
                        </div>

                        <?php if(isset($penghuni)): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tgl_keluar" class="form-label">
                                        <i class="fas fa-calendar-times"></i> Tanggal Keluar
                                    </label>
                                    <input type="date" class="form-control" 
                                           id="tgl_keluar" name="tgl_keluar" 
                                           value="<?= set_value('tgl_keluar', $penghuni->tgl_keluar) ?>"
                                           placeholder="Kosongkan jika masih aktif">
                                    <small class="form-text text-muted">Isi jika penghuni sudah keluar dari kos</small>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('penghuni') ?>" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> 
                                        <?= isset($penghuni) ? 'Update Data' : 'Simpan Data' ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i> Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Semua field yang bertanda <span class="text-danger">*</span> wajib diisi</li>
                        <li>No KTP harus unik dan tidak boleh duplikat</li>
                        <li>Tanggal keluar hanya diisi jika penghuni sudah keluar dari kos</li>
                        <li>Data yang sudah disimpan dapat diubah melalui menu edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto format KTP number
        document.getElementById('no_ktp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 16) {
                value = value.substring(0, 16);
            }
            e.target.value = value;
        });

        // Auto format phone number
        document.getElementById('no_hp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 13) {
                value = value.substring(0, 13);
            }
            e.target.value = value;
        });
    </script>
</body>
</html> 