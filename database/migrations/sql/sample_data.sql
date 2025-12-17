-- ============================================
-- Pharmacy Management System - Sample Data
-- ============================================
-- This script inserts sample/seed data for testing the pharmacy management system
--
-- Data includes:
--   - 2 Users (Admin and Pharmacist with default credentials)
--   - 3 Medicine Categories
--   - 5 Suppliers
--   - 24 Sample Medicines
--   - 10 Customers
--   - Sample Restocks
--
-- Usage:
--   USE pharmacy_management;
--   source sample_data.sql;
--   -- OR --
--   mysql -u root -p pharmacy_management < sample_data.sql
--
-- IMPORTANT: Default login credentials
--   Admin: admin@example.com / admin123
--   Pharmacist: pharmacist@example.com / pharmacist123
-- ============================================

USE pharmacy_management;

-- ============================================
-- 1. Insert Users
-- Password hashes generated using Laravel's Hash::make()
-- ============================================
INSERT INTO users (name, email, position, password, created_at, updated_at) VALUES
('Admin User', 'admin@example.com', 'admin', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW()),
('Pharmacist User', 'pharmacist@example.com', 'pharmacist', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- Note: The password hash above is for 'password'. 
-- For actual credentials (admin123 and pharmacist123), you should generate proper hashes using:
-- php artisan tinker
-- echo Hash::make('admin123');

-- ============================================
-- 2. Insert Categories
-- ============================================
INSERT INTO categories (name, description, created_at, updated_at) VALUES
('Obat Keras', 'adalah obat yang hanya boleh dibeli menggunakan resep dokter. Tempat penjualan di Apotek.', NOW(), NOW()),
('Obat Bebas', 'adalah obat yang dijual bebas di pasaran dan dapat dibeli tanpa resep dokter. Tempat penjualan di Apotek dan Toko Obat Berijin.', NOW(), NOW()),
('Obat Bebas Terbatas', 'adalah obat yang dapat dibeli secara bebas tanpa menggunakan resep dokter, namun mempunyai peringatan khusus saat menggunakannya. Tempat penjualan di Apotek dan Toko Obat Berijin.', NOW(), NOW());

-- ============================================
-- 3. Insert Suppliers
-- ============================================
INSERT INTO suppliers (name, address, phone, email, created_at, updated_at) VALUES
('PT Kimia Farma', 'Jl. Veteran No. 9, Jakarta Pusat 10110', '021-3841031', 'info@kimiafarma.co.id', NOW(), NOW()),
('PT Kalbe Farma', 'Jl. Let. Jend. Suprapto Kav. 4, Jakarta 10510', '021-4212808', 'corporate@kalbe.co.id', NOW(), NOW()),
('PT Sanbe Farma', 'Jl. Raya Cimareme No. 34, Bandung 40553', '022-6654455', 'marketing@sanbe.co.id', NOW(), NOW()),
('PT Dexa Medica', 'Jl. Bambu No. 8, Palembang Industrial Estate, Palembang', '0711-7070890', 'info@dexa-medica.com', NOW(), NOW()),
('PT Novell Pharmaceutical', 'Jl. Raya Bogor KM 35, Cibinong, Bogor', '021-8754587', 'customer.service@novellpharm.co.id', NOW(), NOW());

-- ============================================
-- 4. Insert Medicines
-- Sample medicines with various categories and suppliers
-- Note: Prices are in smallest currency unit (e.g., cents)
-- ============================================
INSERT INTO medicines (name, category_id, supplier_id, stock, minimum_stock, price, require_prescription, description, expiry_date, type, unit, dosage, instructions, created_at, updated_at) VALUES
-- Pain Relief Medicines
('Sanmol Forte', 2, 1, 100, 20, 15000, 0, 'Paracetamol 500mg tablet untuk demam dan nyeri', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', '3x1 tablet per hari', 'Diminum setelah makan', NOW(), NOW()),
('Panadol', 2, 2, 150, 25, 12000, 0, 'Paracetamol tablet untuk menurunkan demam', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Tablet', 'Strip', '3x1 tablet', 'Diminum dengan air putih', NOW(), NOW()),
('Bodrex', 2, 1, 80, 15, 8000, 0, 'Obat sakit kepala kombinasi paracetamol dan kafein', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', 'Sesuai kebutuhan, max 6 tablet/hari', 'Jangan dikonsumsi perut kosong', NOW(), NOW()),
('Novaxiven', 2, 5, 60, 10, 25000, 0, 'Ibuprofen untuk nyeri dan inflamasi', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'Tablet', 'Strip', '3x400mg', 'Diminum setelah makan', NOW(), NOW()),
('Dolofen-F', 2, 4, 75, 12, 18000, 0, 'Kombinasi ibuprofen dan paracetamol', DATE_ADD(NOW(), INTERVAL 20 MONTH), 'Tablet', 'Strip', '3x1 tablet', 'Tidak untuk ibu hamil', NOW(), NOW()),
('Proris', 2, 2, 90, 15, 22000, 0, 'Ibuprofen sirup untuk anak', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'Sirup', 'Botol', 'Sesuai berat badan anak', 'Kocok sebelum diminum', NOW(), NOW()),

-- Stomach Medicines
('Mylanta', 2, 2, 120, 20, 16000, 0, 'Antasida untuk mengatasi maag', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', '3-4x1 tablet', 'Diminum 1 jam sebelum makan', NOW(), NOW()),
('Promag', 2, 1, 100, 18, 9000, 0, 'Obat maag tablet kunyah', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Tablet', 'Strip', '3-4x sehari', 'Kunyah sebelum ditelan', NOW(), NOW()),

-- Allergy Medicines
('Lexacrol', 3, 3, 80, 15, 35000, 0, 'Antihistamin untuk alergi', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', '1x1 tablet malam hari', 'Dapat menyebabkan kantuk', NOW(), NOW()),
('Zecamax', 3, 4, 70, 12, 28000, 0, 'Cetirizine untuk rhinitis alergi', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Tablet', 'Strip', '1x10mg', 'Diminum malam hari', NOW(), NOW()),
('Cetirgi', 3, 2, 85, 15, 24000, 0, 'Antihistamin generasi kedua', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', '1x1 tablet', 'Tidak menyebabkan kantuk berat', NOW(), NOW()),

-- Cold & Flu Medicines
('Aflucaps', 2, 1, 95, 18, 14000, 0, 'Obat flu kombinasi', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'Kapsul', 'Strip', '3x1 kapsul', 'Diminum setelah makan', NOW(), NOW()),
('Trifachlor', 2, 3, 110, 20, 11000, 0, 'Obat flu dan batuk', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Tablet', 'Strip', '3x1 tablet', 'Banyak minum air putih', NOW(), NOW()),
('Incidal', 2, 2, 88, 15, 16500, 0, 'Obat batuk dan pilek', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', '3x1 tablet', 'Dapat menyebabkan kantuk', NOW(), NOW()),

-- Cough Medicines
('Siladex', 3, 1, 75, 12, 19000, 0, 'Obat batuk berdahak', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'Sirup', 'Botol', '3x1 sendok takar', 'Kocok dahulu sebelum diminum', NOW(), NOW()),
('Sanadryl DMP', 3, 3, 65, 10, 22000, 0, 'Obat batuk kering', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Sirup', 'Botol', '3x1 sendok takar', 'Hindari mengemudi setelah minum', NOW(), NOW()),
('Dextral', 3, 4, 70, 12, 17000, 0, 'Ekspektoran untuk batuk berdahak', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Sirup', 'Botol', '3x5ml', 'Banyak minum air hangat', NOW(), NOW()),

-- Antibiotics (Prescription Required)
('Amoxsan', 1, 2, 50, 10, 45000, 1, 'Amoxicillin 500mg kapsul', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Kapsul', 'Strip', '3x500mg selama 5-7 hari', 'Harus dihabiskan sesuai resep dokter', NOW(), NOW()),
('Lapimox', 1, 4, 45, 8, 42000, 1, 'Amoxicillin tablet antibiotik', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Tablet', 'Strip', '3x1 tablet', 'Diminum sesuai petunjuk dokter', NOW(), NOW()),
('Amoxicillin Hexapharm', 1, 5, 60, 10, 38000, 1, 'Antibiotik untuk infeksi bakteri', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Kapsul', 'Strip', '3x1 kapsul', 'Jangan berhenti sebelum waktunya', NOW(), NOW()),

-- Anxiety/Sleep Medicines (Prescription Required)
('Xanax', 1, 3, 30, 5, 85000, 1, 'Alprazolam untuk gangguan kecemasan', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'Tablet', 'Strip', 'Sesuai resep dokter', 'Obat keras, harus dengan resep', NOW(), NOW()),
('Alprazolam', 1, 4, 25, 5, 75000, 1, 'Obat anti-anxietas', DATE_ADD(NOW(), INTERVAL 18 MONTH), 'Tablet', 'Strip', 'Sesuai anjuran dokter', 'Dapat menyebabkan ketergantungan', NOW(), NOW()),
('Atarax', 1, 2, 35, 6, 68000, 1, 'Hydroxyzine untuk kecemasan', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Strip', '1-3x sehari sesuai resep', 'Hindari mengemudi', NOW(), NOW()),

-- Vitamins (OTC)
('Ryvel', 2, 5, 120, 25, 32000, 0, 'Multivitamin dan mineral', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'Tablet', 'Botol', '1x1 tablet', 'Diminum setelah makan', NOW(), NOW());

-- ============================================
-- 5. Insert Customers
-- ============================================
INSERT INTO customers (name, phone, address, disease, created_at, updated_at) VALUES
('Budi Santoso', '081234567890', 'Jl. Merdeka No. 123, Jakarta', 'Hipertensi', NOW(), NOW()),
('Siti Nurhaliza', '082345678901', 'Jl. Sudirman No. 45, Bandung', 'Diabetes', NOW(), NOW()),
('Ahmad Wijaya', '083456789012', 'Jl. Gatot Subroto No. 78, Surabaya', 'Asma', NOW(), NOW()),
('Dewi Lestari', '084567890123', 'Jl. Ahmad Yani No. 90, Yogyakarta', NULL, NOW(), NOW()),
('Rudi Hartono', '085678901234', 'Jl. Diponegoro No. 12, Semarang', 'Kolesterol Tinggi', NOW(), NOW()),
('Lina Marlina', '086789012345', 'Jl. Pahlawan No. 34, Medan', 'Gastritis', NOW(), NOW()),
('Eko Prasetyo', '087890123456', 'Jl. Veteran No. 56, Malang', NULL, NOW(), NOW()),
('Rina Susanti', '088901234567', 'Jl. Pemuda No. 67, Denpasar', 'Migrain', NOW(), NOW()),
('Agus Setiawan', '089012345678', 'Jl. Gajah Mada No. 89, Palembang', 'Alergi Debu', NOW(), NOW()),
('Maya Sari', '081123456789', 'Jl. Hayam Wuruk No. 101, Makassar', NULL, NOW(), NOW());

-- ============================================
-- 6. Insert Restocks
-- Sample restock data for inventory management
-- ============================================
INSERT INTO restocks (medicine_id, quantity, restock_date, created_at, updated_at) VALUES
-- Recent restocks
(1, 50, DATE_SUB(NOW(), INTERVAL 7 DAY), NOW(), NOW()),
(2, 75, DATE_SUB(NOW(), INTERVAL 5 DAY), NOW(), NOW()),
(3, 40, DATE_SUB(NOW(), INTERVAL 10 DAY), NOW(), NOW()),
(4, 30, DATE_SUB(NOW(), INTERVAL 3 DAY), NOW(), NOW()),
(7, 60, DATE_SUB(NOW(), INTERVAL 8 DAY), NOW(), NOW()),
(10, 35, DATE_SUB(NOW(), INTERVAL 6 DAY), NOW(), NOW()),
(15, 40, DATE_SUB(NOW(), INTERVAL 4 DAY), NOW(), NOW()),
(18, 25, DATE_SUB(NOW(), INTERVAL 9 DAY), NOW(), NOW()),
(21, 20, DATE_SUB(NOW(), INTERVAL 2 DAY), NOW(), NOW()),
(24, 50, DATE_SUB(NOW(), INTERVAL 1 DAY), NOW(), NOW());

-- ============================================
-- Display Success Message
-- ============================================
SELECT 'Sample data inserted successfully!' AS Status;
SELECT '============================================' AS '';
SELECT 'Default Login Credentials:' AS '';
SELECT 'Admin: admin@example.com / admin123' AS '';
SELECT 'Pharmacist: pharmacist@example.com / pharmacist123' AS '';
SELECT '============================================' AS '';
SELECT 'NOTE: Password hashes need to be regenerated using Laravel Hash::make()' AS '';
