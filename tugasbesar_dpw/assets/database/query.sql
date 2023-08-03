CREATE DATABASE javaneseteakhubdata;

USE javaneseteakhubdata;

CREATE TABLE user_penjual (
  id_pnjl INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nama_pnjl VARCHAR(20)
);

INSERT INTO user_penjual (nama_pnjl)
VALUES ('Susi Maranatha');

CREATE TABLE users (
  id_pmbli INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name VARCHAR(255),
  email VARCHAR(255),
  tel VARCHAR(20),
  password VARCHAR(255)
);

CREATE TABLE produk (
  id_produk INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_pnjl INT,
  nama_produk VARCHAR(15),
  dkps_produk VARCHAR(1000),
  harga DECIMAL(10, 2),
  stock INT(10),
  FOREIGN KEY (id_pnjl) REFERENCES user_penjual (id_pnjl)
);

INSERT INTO produk (id_pnjl, nama_produk, dkps_produk, harga, stock)
VALUES
(1, 'paketmebel1', 'Sofa Cream Empuk kami adalah simbol sempurna dari kesempurnaan dan kenyamanan...', 5500000, 100),
(1, 'paketmebel2', 'Paket Mebel 2 dengan bahan rotan kami adalah pilihan sempurna...', 3500000, 100),
(1, 'paketmebel3', 'Dapatkan suasana hangat dan menyambut dalam ruangan Anda dengan...', 1000000, 100),
(1, 'paketmebel4', 'Paket Mebel 4 adalah pilihan sempurna untuk menciptakan suasana ruangan...', 2500000, 100),
(1, 'paketmebel5', 'Paket Mebel 5 adalah jawaban atas keinginan Anda untuk menciptakan ruang...', 2500000, 100),
(1, 'paketmebel6', 'Paket Mebel 6 adalah pilihan ideal bagi Anda yang mengutamakan gaya dan...', 500000, 100),
(1, 'paketmebel7', 'Paket Mebel 7 adalah simbol keanggunan dan kemewahan dalam desain interior...', 3500000, 100),
(1, 'paketmebel8', 'Paket Mebel 8 menghadirkan keanggunan sederhana dengan sentuhan kontemporer...', 1200000, 100),
(1, 'paketmebel9', 'Paket Mebel 9 adalah pilihan sempurna bagi Anda yang mengutamakan kesederhanaan...', 1100000, 100);

CREATE TABLE pesan (
  id_pesan INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_pmbli INT,
  id_produk INT,
  tgl_pesan DATE,
  total_harga DECIMAL(10, 2),
  FOREIGN KEY (id_pmbli) REFERENCES users (id_pmbli),
  FOREIGN KEY (id_produk) REFERENCES produk (id_produk)
);

CREATE TABLE pembayaran (
  id_pmbyrn INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_pesan INT,
  mtd_pmbyrn VARCHAR(20),
  ttl_pmbyrn VARCHAR(20),
  tgl_pembayaran DATE,
  FOREIGN KEY (id_pesan) REFERENCES pesan (id_pesan)
);

CREATE TABLE userr_detail (
  nama_lengkap VARCHAR(500),
  tanggal_lahir DATE,
  nomor_telepon VARCHAR(100),
  ibu_kandung VARCHAR(100),
  email VARCHAR(500)
);

CREATE TABLE pengiriman (
  id_pngrm INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_pesan INT,
  estimasi VARCHAR(50),
  FOREIGN KEY (id_pesan) REFERENCES pesan (id_pesan)
);
