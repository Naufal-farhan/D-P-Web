

-- Skema tabel order_rental untuk PostgreSQL (Jobsheet 8)
CREATE TABLE IF NOT EXISTS order_rental (
    id SERIAL PRIMARY KEY,
    jenis VARCHAR(255) NOT NULL,
    penyewa VARCHAR(255) NOT NULL,
    sopir VARCHAR(255) NOT NULL,
    masa INTEGER NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Skema tabel sopir untuk PostgreSQL (Jobsheet 8)
CREATE TABLE IF NOT EXISTS sopir (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_supir VARCHAR(50) NOT NULL UNIQUE,
    alamat VARCHAR(255),
    no_hp VARCHAR(30),
    tgl_gabung DATE,
    email VARCHAR(255)
);
INSERT INTO order_rental (jenis, penyewa, sopir, masa) VALUES
('Toyota Avanza Veloz', 'Budi Santoso', 'Ahmad Dahlan', 3),
('Toyota Innova Zenix', 'Siti Nurhaliza', 'Rian Hidayat', 2),
('Mitsubishi Pajero Sport', 'Doni Pratama', 'Eko Wijaya', 5),
('Daihatsu Xenia', 'Rina Kartika', 'Ahmad Dahlan', 1),
('Toyota Hiace Commuter', 'PT Maju Bersama', 'Bambang Suroso', 4);