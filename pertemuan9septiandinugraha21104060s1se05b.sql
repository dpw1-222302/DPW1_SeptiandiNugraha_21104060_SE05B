CREATE TABLE `user` (
  `id` int PRIMARY KEY,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
);

CREATE TABLE `divisi` (
  `id` int PRIMARY KEY,
  `kep_div_id` int NOT NULL,
  `id_anggota` int NOT NULL
);

CREATE TABLE `kegiatan` (
  `id` int PRIMARY KEY,
  `user_id` int NOT NULL,
  `divisi_id` int NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
);

CREATE TABLE `acc_kegiatan` (
  `id` int PRIMARY KEY,
  `keg_id` int NOT NULL,
  `acc` boolean NOT NULL
);

ALTER TABLE `kegiatan` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `kegiatan` ADD FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`);

ALTER TABLE `divisi` ADD FOREIGN KEY (`kep_div_id`) REFERENCES `user` (`id`);

ALTER TABLE `divisi` ADD FOREIGN KEY (`id_anggota`) REFERENCES `user` (`id`);

ALTER TABLE `acc_kegiatan` ADD FOREIGN KEY (`keg_id`) REFERENCES `kegiatan` (`id`);
