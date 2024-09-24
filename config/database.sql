CREATE DATABASE db_pilkada;
USE db_pilkada;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Menyimpan password yang sudah di-hash
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE daftar_pemilih_tetap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_tps VARCHAR(50),
    nama_pemilih VARCHAR(100),
    nik VARCHAR(20),
    alamat TEXT,
    status_pemilih ENUM('Terdaftar', 'Tidak Terdaftar')
);

CREATE TABLE koordinator_tps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_tps VARCHAR(50),
    nama_koordinator VARCHAR(100),
    kontak VARCHAR(15),
    alamat TEXT
);

CREATE TABLE koordinator_desa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_desa VARCHAR(100),
    nama_koordinator VARCHAR(100),
    kontak VARCHAR(15),
    alamat TEXT
);

CREATE TABLE koordinator_kecamatan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kecamatan VARCHAR(100),
    nama_koordinator VARCHAR(100),
    kontak VARCHAR(15),
    alamat TEXT
);

CREATE TABLE berita (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    isi_berita TEXT NOT NULL,
    images VARCHAR(255) NOT NULL
);

