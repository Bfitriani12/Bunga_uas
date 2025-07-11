-- =====================================================
-- DATABASE SISTEM KOS-KOSAN
-- Created for: Tugas UAS
-- =====================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS db_kos;
USE db_kos;

-- =====================================================
-- TABEL PENGHUNI
-- =====================================================
CREATE TABLE tb_penghuni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_ktp VARCHAR(20) NOT NULL UNIQUE,
    no_hp VARCHAR(15) NOT NULL,
    tgl_masuk DATE NOT NULL,
    tgl_keluar DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL KAMAR
-- =====================================================
CREATE TABLE tb_kamar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor VARCHAR(10) NOT NULL UNIQUE,
    harga INT NOT NULL,
    status ENUM('tersedia', 'terisi') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL BARANG
-- =====================================================
CREATE TABLE tb_barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL KAMAR PENGHUNI (RELASI MANY-TO-MANY)
-- =====================================================
CREATE TABLE tb_kmr_penghuni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kamar INT NOT NULL,
    id_penghuni INT NOT NULL,
    tgl_masuk DATE NOT NULL,
    tgl_keluar DATE NULL,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kamar) REFERENCES tb_kamar(id) ON DELETE CASCADE,
    FOREIGN KEY (id_penghuni) REFERENCES tb_penghuni(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL BARANG BAWAAN (RELASI MANY-TO-MANY)
-- =====================================================
CREATE TABLE tb_brng_bawaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_penghuni INT NOT NULL,
    id_barang INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_penghuni) REFERENCES tb_penghuni(id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES tb_barang(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL TAGIHAN
-- =====================================================
CREATE TABLE tb_tagihan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bulan VARCHAR(7) NOT NULL, -- Format: YYYY-MM
    id_kmr_penghuni INT NOT NULL,
    jml_tagihan INT NOT NULL,
    status ENUM('belum_bayar', 'cicil', 'lunas') DEFAULT 'belum_bayar',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kmr_penghuni) REFERENCES tb_kmr_penghuni(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL PEMBAYARAN
-- =====================================================
CREATE TABLE tb_bayar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tagihan INT NOT NULL,
    jml_bayar INT NOT NULL,
    status ENUM('lunas', 'cicil') NOT NULL,
    tgl_bayar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tagihan) REFERENCES tb_tagihan(id) ON DELETE CASCADE
);

-- =====================================================
-- INDEX UNTUK OPTIMASI PERFORMANCE
-- =====================================================
CREATE INDEX idx_penghuni_no_ktp ON tb_penghuni(no_ktp);
CREATE INDEX idx_kamar_nomor ON tb_kamar(nomor);
CREATE INDEX idx_tagihan_bulan ON tb_tagihan(bulan);
CREATE INDEX idx_kmr_penghuni_status ON tb_kmr_penghuni(status);

-- =====================================================
-- DATA SAMPLE UNTUK TESTING
-- =====================================================

-- Insert sample kamar
INSERT INTO tb_kamar (nomor, harga, status) VALUES
('A1', 500000, 'tersedia'),
('A2', 550000, 'tersedia'),
('A3', 500000, 'tersedia'),
('B1', 600000, 'tersedia'),
('B2', 650000, 'tersedia');

-- Insert sample barang
INSERT INTO tb_barang (nama, harga) VALUES
('AC', 100000),
('Kipas Angin', 50000),
('Lemari', 75000),
('Meja Belajar', 60000),
('Kursi', 45000);

-- Insert sample penghuni
INSERT INTO tb_penghuni (nama, no_ktp, no_hp, tgl_masuk) VALUES
('Ahmad Fauzi', '1234567890123456', '081234567890', '2024-01-15'),
('Siti Nurhaliza', '2345678901234567', '082345678901', '2024-02-01'),
('Budi Santoso', '3456789012345678', '083456789012', '2024-01-20');

-- Insert sample kamar penghuni
INSERT INTO tb_kmr_penghuni (id_kamar, id_penghuni, tgl_masuk, status) VALUES
(1, 1, '2024-01-15', 'aktif'),
(2, 2, '2024-02-01', 'aktif'),
(3, 3, '2024-01-20', 'aktif');

-- Update status kamar menjadi terisi
UPDATE tb_kamar SET status = 'terisi' WHERE id IN (1, 2, 3);

-- Insert sample barang bawaan
INSERT INTO tb_brng_bawaan (id_penghuni, id_barang) VALUES
(1, 1), -- Ahmad dengan AC
(1, 3), -- Ahmad dengan Lemari
(2, 2), -- Siti dengan Kipas Angin
(2, 4), -- Siti dengan Meja Belajar
(3, 1), -- Budi dengan AC
(3, 5); -- Budi dengan Kursi

-- Insert sample tagihan
INSERT INTO tb_tagihan (bulan, id_kmr_penghuni, jml_tagihan, status) VALUES
('2024-01', 1, 675000, 'lunas'), -- Ahmad: 500k kamar + 175k barang
('2024-02', 1, 675000, 'belum_bayar'),
('2024-02', 2, 685000, 'belum_bayar'), -- Siti: 550k kamar + 135k barang
('2024-01', 3, 620000, 'cicil'); -- Budi: 500k kamar + 120k barang

-- Insert sample pembayaran
INSERT INTO tb_bayar (id_tagihan, jml_bayar, status) VALUES
(1, 675000, 'lunas'),
(4, 300000, 'cicil');

-- =====================================================
-- VIEW UNTUK MEMUDAHKAN QUERY
-- =====================================================

-- View untuk melihat detail penghuni dengan kamar
CREATE VIEW v_penghuni_kamar AS
SELECT 
    p.id,
    p.nama,
    p.no_ktp,
    p.no_hp,
    p.tgl_masuk,
    p.tgl_keluar,
    k.nomor as nomor_kamar,
    k.harga as harga_kamar,
    kp.tgl_masuk as tgl_masuk_kamar,
    kp.tgl_keluar as tgl_keluar_kamar,
    kp.status as status_kamar
FROM tb_penghuni p
LEFT JOIN tb_kmr_penghuni kp ON p.id = kp.id_penghuni AND kp.status = 'aktif'
LEFT JOIN tb_kamar k ON kp.id_kamar = k.id;

-- View untuk melihat tagihan dengan detail
CREATE VIEW v_tagihan_detail AS
SELECT 
    t.id,
    t.bulan,
    p.nama as nama_penghuni,
    k.nomor as nomor_kamar,
    t.jml_tagihan,
    t.status as status_tagihan,
    COALESCE(SUM(b.jml_bayar), 0) as total_bayar,
    (t.jml_tagihan - COALESCE(SUM(b.jml_bayar), 0)) as sisa_tagihan
FROM tb_tagihan t
JOIN tb_kmr_penghuni kp ON t.id_kmr_penghuni = kp.id
JOIN tb_penghuni p ON kp.id_penghuni = p.id
JOIN tb_kamar k ON kp.id_kamar = k.id
LEFT JOIN tb_bayar b ON t.id = b.id_tagihan
GROUP BY t.id, t.bulan, p.nama, k.nomor, t.jml_tagihan, t.status;

-- =====================================================
-- STORED PROCEDURE UNTUK OPERASI UMUM
-- =====================================================

DELIMITER //

-- Procedure untuk menambah penghuni baru
CREATE PROCEDURE sp_tambah_penghuni(
    IN p_nama VARCHAR(100),
    IN p_no_ktp VARCHAR(20),
    IN p_no_hp VARCHAR(15),
    IN p_nomor_kamar VARCHAR(10),
    IN p_tgl_masuk DATE
)
BEGIN
    DECLARE v_id_kamar INT;
    DECLARE v_id_penghuni INT;
    
    -- Cari id kamar
    SELECT id INTO v_id_kamar FROM tb_kamar WHERE nomor = p_nomor_kamar AND status = 'tersedia';
    
    IF v_id_kamar IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Kamar tidak tersedia atau tidak ditemukan';
    ELSE
        -- Insert penghuni
        INSERT INTO tb_penghuni (nama, no_ktp, no_hp, tgl_masuk) 
        VALUES (p_nama, p_no_ktp, p_no_hp, p_tgl_masuk);
        
        SET v_id_penghuni = LAST_INSERT_ID();
        
        -- Assign kamar ke penghuni
        INSERT INTO tb_kmr_penghuni (id_kamar, id_penghuni, tgl_masuk) 
        VALUES (v_id_kamar, v_id_penghuni, p_tgl_masuk);
        
        -- Update status kamar
        UPDATE tb_kamar SET status = 'terisi' WHERE id = v_id_kamar;
        
        SELECT 'Penghuni berhasil ditambahkan' as message;
    END IF;
END //

-- Procedure untuk keluar penghuni
CREATE PROCEDURE sp_keluar_penghuni(
    IN p_id_penghuni INT,
    IN p_tgl_keluar DATE
)
BEGIN
    DECLARE v_id_kamar INT;
    
    -- Update tanggal keluar penghuni
    UPDATE tb_penghuni SET tgl_keluar = p_tgl_keluar WHERE id = p_id_penghuni;
    
    -- Update status kamar penghuni
    UPDATE tb_kmr_penghuni 
    SET tgl_keluar = p_tgl_keluar, status = 'nonaktif' 
    WHERE id_penghuni = p_id_penghuni AND status = 'aktif';
    
    -- Ambil id kamar untuk update status
    SELECT id_kamar INTO v_id_kamar 
    FROM tb_kmr_penghuni 
    WHERE id_penghuni = p_id_penghuni AND status = 'nonaktif' 
    ORDER BY id DESC LIMIT 1;
    
    -- Update status kamar menjadi tersedia
    UPDATE tb_kamar SET status = 'tersedia' WHERE id = v_id_kamar;
    
    SELECT 'Penghuni berhasil dikeluarkan' as message;
END //

DELIMITER ;

-- =====================================================
-- TRIGGER UNTUK AUTO UPDATE
-- =====================================================

-- Trigger untuk update status tagihan otomatis
DELIMITER //
CREATE TRIGGER tr_update_status_tagihan
AFTER INSERT ON tb_bayar
FOR EACH ROW
BEGIN
    DECLARE v_total_tagihan INT;
    DECLARE v_total_bayar INT;
    
    -- Ambil total tagihan
    SELECT jml_tagihan INTO v_total_tagihan 
    FROM tb_tagihan WHERE id = NEW.id_tagihan;
    
    -- Hitung total bayar
    SELECT COALESCE(SUM(jml_bayar), 0) INTO v_total_bayar 
    FROM tb_bayar WHERE id_tagihan = NEW.id_tagihan;
    
    -- Update status tagihan
    IF v_total_bayar >= v_total_tagihan THEN
        UPDATE tb_tagihan SET status = 'lunas' WHERE id = NEW.id_tagihan;
    ELSE
        UPDATE tb_tagihan SET status = 'cicil' WHERE id = NEW.id_tagihan;
    END IF;
END //
DELIMITER ;

-- =====================================================
-- SAMPLE QUERY UNTUK TESTING
-- =====================================================

-- Query untuk melihat penghuni aktif
-- SELECT * FROM v_penghuni_kamar WHERE status_kamar = 'aktif';

-- Query untuk melihat tagihan yang belum lunas
-- SELECT * FROM v_tagihan_detail WHERE status_tagihan != 'lunas';

-- Query untuk melihat kamar yang tersedia
-- SELECT * FROM tb_kamar WHERE status = 'tersedia';

-- Query untuk melihat total pendapatan per bulan
-- SELECT 
--     bulan,
--     SUM(jml_tagihan) as total_tagihan,
--     SUM(total_bayar) as total_bayar,
--     SUM(sisa_tagihan) as sisa_tagihan
-- FROM v_tagihan_detail 
-- GROUP BY bulan 
-- ORDER BY bulan DESC; 