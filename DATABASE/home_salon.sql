-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2023 pada 01.56
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_salon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_pemesanan`
--

CREATE TABLE `detil_pemesanan` (
  `id_detil_pemesanan` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_pesan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detil_pemesanan`
--

INSERT INTO `detil_pemesanan` (`id_detil_pemesanan`, `id_pemesanan`, `id_produk`, `harga_pesan`) VALUES
(85, 56, 4, 35000),
(86, 57, 4, 35000),
(87, 58, 1, 450000),
(100, 69, 4, 35000),
(102, 71, 4, 35000),
(103, 72, 4, 35000),
(104, 73, 1, 450000),
(105, 74, 9, 25000),
(106, 75, 4, 35000),
(107, 76, 4, 35000),
(108, 76, 8, 55000),
(109, 77, 9, 25000),
(110, 77, 4, 35000),
(111, 78, 1, 450000),
(112, 78, 4, 35000),
(113, 79, 4, 35000),
(114, 80, 8, 55000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `rekening` varchar(100) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `maps` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `email`, `nama_bank`, `rekening`, `atas_nama`, `no_telp`, `meta_deskripsi`, `meta_keyword`, `favicon`, `alamat`, `maps`) VALUES
(1, 'Home Salon - Rumah Kecantikan dan Kegantengan', 'homesalon@mail.com', 'BRI', '123456789', 'Home Salon', '082377823390', 'Home Salon adalah Rumah Kecantikan dan Kegantengan', 'Salon, Kecantikan, Perawatan, Kegantengan', 'bulan-bintang-vector-png-25.png', 'Jl. Irian Seringgu', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.1969107839027!2d101.4334664146185!3d-2.0770755375854657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2da390958191a5%3A0x1dec6a3653b9ab48!2sBlackExpo!5e0!3m2!1sid!2sid!4v1602350979207!5m2!1sid!2sid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(11) NOT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `buka` time DEFAULT NULL,
  `tutup` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam`
--

INSERT INTO `jam` (`id_jam`, `hari`, `buka`, `tutup`) VALUES
(1, 'Senin', '08:00:00', '17:00:00'),
(2, 'Selasa', '08:00:00', '17:00:00'),
(3, 'Rabu', '08:00:00', '17:00:00'),
(4, 'Kamis', '08:00:00', '17:00:00'),
(7, 'Jumat', '08:00:00', '17:00:00'),
(8, 'Sabtu', '00:00:00', '00:00:00'),
(9, 'Minggu', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis_perawatan` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `jenis_perawatan`, `deskripsi`) VALUES
(9, 'Coloring', 'Mengkilapkan rambut'),
(11, 'Hair Do', 'Perawatan Rambut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_to_produk`
--

CREATE TABLE `jenis_to_produk` (
  `id_jenistoproduk` int(11) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_to_produk`
--

INSERT INTO `jenis_to_produk` (`id_jenistoproduk`, `id_jenis`, `id_produk`) VALUES
(17, 11, 9),
(18, 11, 4),
(19, 9, 1),
(21, 9, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `total_transfer` varchar(20) NOT NULL,
  `no_rek` varchar(150) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_pemesanan`, `total_transfer`, `no_rek`, `nama_pengirim`, `tanggal_transfer`, `bukti_transfer`) VALUES
(6, 69, 'Rp. 35,000', 'BRI : 123456789 (a.n. Home Salon)', 'donatur1@mail.com', '2023-02-22', 'kemeja-1.jpg'),
(7, 76, 'Rp. 90,000', 'BRI : 123456789 (a.n. Home Salon)', 'tes', '2023-03-17', 'kemeja-11.jpg'),
(8, 77, 'Rp. 60,000', 'BRI : 123456789 (a.n. Home Salon)', 'Fahril', '2023-03-19', '5226644-removebg.png'),
(9, 78, 'Rp. 485,000', 'BRI : 123456789 (a.n. Home Salon)', 'pembeli2@mail.com', '2023-04-05', 'sfy.png'),
(10, 79, 'Rp. 35,000', 'BRI : 123456789 (a.n. Home Salon)', 'test@mail.com', '2023-04-07', 'CV-ratna.png'),
(11, 80, 'Rp. 55,000', 'BRI : 123456789 (a.n. Home Salon)', 'admin@mail.com', '2023-04-07', 'peta_kabupaten_merauke.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `bank` varchar(50) NOT NULL,
  `atas_nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `password`, `alamat`, `no_telp`, `no_rek`, `bank`, `atas_nama`) VALUES
(1, 'Pelanggan Satu, S.Kom', 'fahrilsariannur@gmail.com', '8880e718ebd94c737f18cbf083c9adc733b01d5f030ed5b87bd3d103ac84781f194bd64d11070c58b97c0f07202d69711aa336b859a1a010f89f8c44de609261', 'Jl. Satu', '6281210265778', '948539839', 'BRI', 'Pelanggan Satu'),
(4, 'Fahril Sarian Nur', 'katuk@gmail.com', 'd7d2f602e155ba700ed76c48d9a48009b9383e8d17435bfb0fe8ad7c664d4002f16cc7a65c6fb066963714a794f96441ef7f9b9c1b1456acfb9225cbad474fb0', 'Jl. Irian Seringgu  RT 003  RW 001  Kel. Seringgu Jaya', '085344935859', '035201066304500', 'BRI', 'Fahril Sarian Nur'),
(6, 'Pelanggan 2', 'pelanggan2@mail.com', 'd7d2f602e155ba700ed76c48d9a48009b9383e8d17435bfb0fe8ad7c664d4002f16cc7a65c6fb066963714a794f96441ef7f9b9c1b1456acfb9225cbad474fb0', 'Jl tes', '32849', '932984', 'BRI', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `no_transaksi` varchar(150) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_antrian` varchar(20) DEFAULT NULL,
  `tanggal_treatment` datetime DEFAULT NULL,
  `tanggal_refund` datetime DEFAULT NULL,
  `bukti_refund` varchar(255) DEFAULT NULL,
  `id_terapis` int(11) NOT NULL DEFAULT 0,
  `kembali` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `c_order` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `no_transaksi`, `id_pelanggan`, `no_antrian`, `tanggal_treatment`, `tanggal_refund`, `bukti_refund`, `id_terapis`, `kembali`, `status`, `c_order`) VALUES
(56, 'TRX-20230216172539', 1, 'HS-001', '2023-02-17 08:25:39', NULL, NULL, 0, '28000', 0, 2),
(57, 'TRX-20230218141139', 1, 'HS-001', '2023-02-20 05:11:39', NULL, NULL, 0, NULL, 0, 0),
(58, 'TRX-20230218141223', 1, 'HS-001', '2023-02-19 20:12:23', NULL, NULL, 0, NULL, 4, 1),
(69, 'TRX-20230222203751', 1, 'HS-005', '2023-02-23 08:37:51', NULL, NULL, 2, NULL, 4, 1),
(71, 'TRX-20230223073154', 1, 'HS-006', '2023-02-23 08:16:54', NULL, NULL, 0, NULL, 0, 0),
(72, 'TRX-20230223074342', 1, 'HS-007', '2023-02-23 08:28:42', NULL, NULL, 0, NULL, 0, 0),
(73, 'TRX-20230223074425', 1, 'HS-008', '2023-02-23 08:29:25', '2023-04-08 05:11:00', '12.png', 0, '360000', 0, 3),
(74, 'TRX-20230223075629', 1, 'HS-009', '2023-02-23 08:41:29', NULL, NULL, 0, '20000', 0, 2),
(76, 'TRX-20230317074156', 1, 'HS-002', '2023-03-19 14:35:00', NULL, NULL, 2, NULL, 4, 1),
(77, 'TRX-20230319124029', 1, 'HS-003', '2023-03-19 14:50:00', NULL, NULL, 6, NULL, 4, 1),
(78, 'TRX-20230405081705', 1, 'HS-001', '2023-04-06 09:55:00', NULL, NULL, 2, NULL, 4, 1),
(79, 'TRX-20230407081122', 1, 'HS-001', '2023-04-07 10:35:00', '2023-04-07 11:39:00', '', 2, '28000', 2, 3),
(80, 'TRX-20230407081854', 1, 'HS-002', '2023-04-07 11:20:00', NULL, NULL, 6, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_temp`
--

CREATE TABLE `pemesanan_temp` (
  `id_detil_pemesanan` int(11) NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_pesan` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `harga` varchar(10) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jam` int(5) DEFAULT NULL,
  `menit` int(5) DEFAULT NULL,
  `aktif` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`, `deskripsi`, `jam`, `menit`, `aktif`) VALUES
(1, 'Color Fives', '450000', 'Shampo', 1, 30, 1),
(4, 'Shampo/dry', '35000', 'Shampo/dry', 0, 10, 1),
(8, 'Gunting', '55000', 'Gunting', 0, 20, 1),
(9, 'Gunting Poni', '25000', 'Gunting Poni', 0, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentangkami`
--

CREATE TABLE `tentangkami` (
  `id` int(11) NOT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `judul_seo` varchar(150) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tentangkami`
--

INSERT INTO `tentangkami` (`id`, `judul`, `judul_seo`, `isi`, `gambar`) VALUES
(1, 'Tentang Kami', 'tentang-kami', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur fugiat, temporibus enim commodi iusto libero magni deleniti quod quam consequuntur! Commodi minima excepturi repudiandae velit hic maxime doloremque. Quaerat provident commodi consectetur veniam similique ad earum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo fugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore suscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium modi minima sunt esse temporibus sint culpa, recusandae aliquam numquam totam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam quasi aliquam eligendi, placeat qui corporis!</p>\r\n', 'about1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terapis`
--

CREATE TABLE `terapis` (
  `id_terapis` int(11) NOT NULL,
  `nama_terapis` varchar(100) DEFAULT NULL,
  `telp_terapis` varchar(20) DEFAULT NULL,
  `alamat_terapis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `terapis`
--

INSERT INTO `terapis` (`id_terapis`, `nama_terapis`, `telp_terapis`, `alamat_terapis`) VALUES
(1, 'Terapis Satu', '038378', 'Jl. Martadinata'),
(2, 'Terapis Dua', '081293', 'Jl. Seringgu'),
(6, 'Terapis Tiga', '0822336655', 'Jl. In Ajha');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `tipe` varchar(30) DEFAULT NULL,
  `alamat_user` text DEFAULT NULL,
  `telp_user` varchar(20) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama_lengkap`, `password`, `tipe`, `alamat_user`, `telp_user`, `email_user`, `foto`) VALUES
(4, 'kasir', 'Kasir', 'd7d2f602e155ba700ed76c48d9a48009b9383e8d17435bfb0fe8ad7c664d4002f16cc7a65c6fb066963714a794f96441ef7f9b9c1b1456acfb9225cbad474fb0', 'Kasir', 'Jl. Arafura', '43345', 'kasir@mail.com', 'p1.jpg'),
(7, 'owner', 'Owner Satu', '6914ae53b44a441eaa4e6fead79084064a051c775e662dfdc67bbfdabe0d1d7d631988ad89a17c36f403a6b03c8aae4b27608236b0dad573108f4c6ebec65048', 'Pimpinan', 'Jl. Spadem', '081223236633', 'owner@mail.com', 'download.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detil_pemesanan`
--
ALTER TABLE `detil_pemesanan`
  ADD PRIMARY KEY (`id_detil_pemesanan`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indeks untuk tabel `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jenis_to_produk`
--
ALTER TABLE `jenis_to_produk`
  ADD PRIMARY KEY (`id_jenistoproduk`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `pemesanan_temp`
--
ALTER TABLE `pemesanan_temp`
  ADD PRIMARY KEY (`id_detil_pemesanan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tentangkami`
--
ALTER TABLE `tentangkami`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `terapis`
--
ALTER TABLE `terapis`
  ADD PRIMARY KEY (`id_terapis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detil_pemesanan`
--
ALTER TABLE `detil_pemesanan`
  MODIFY `id_detil_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jenis_to_produk`
--
ALTER TABLE `jenis_to_produk`
  MODIFY `id_jenistoproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_temp`
--
ALTER TABLE `pemesanan_temp`
  MODIFY `id_detil_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tentangkami`
--
ALTER TABLE `tentangkami`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `terapis`
--
ALTER TABLE `terapis`
  MODIFY `id_terapis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `konfirmasi_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
