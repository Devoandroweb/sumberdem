-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2022 pada 11.31
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_profile`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_foto`
--

CREATE TABLE `m_foto` (
  `id_foto` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_foto`
--

INSERT INTO `m_foto` (`id_foto`, `title`, `image`, `deskripsi`) VALUES
(7, NULL, '1662250971_carousel-1.jpg', NULL),
(8, NULL, '1662250971_carousel-2.jpg', NULL),
(9, NULL, '1662250971_carousel-3.jpg', NULL),
(10, NULL, '1662254877_gallery-6.jpg', NULL),
(11, NULL, '1662254877_img-600x400-2.jpg', NULL),
(12, NULL, '1662254877_img-600x400-4.jpg', NULL),
(13, NULL, '1662254877_carousel-1.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_galery`
--

CREATE TABLE `m_galery` (
  `id_galery` int(11) NOT NULL,
  `tipe` tinyint(4) DEFAULT NULL COMMENT '1 : Foto\n2 : Vidio',
  `id_vidio` int(11) DEFAULT NULL,
  `id_foto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kritik_saran`
--

CREATE TABLE `m_kritik_saran` (
  `id_kritik_saran` int(11) NOT NULL,
  `nama_pengunjung` varchar(225) DEFAULT NULL,
  `no_telp` varchar(16) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_menu`
--

CREATE TABLE `m_menu` (
  `id_menu` int(11) NOT NULL,
  `title` text NOT NULL,
  `label` text NOT NULL,
  `id_pages` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `aktif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_menu`
--

INSERT INTO `m_menu` (`id_menu`, `title`, `label`, `id_pages`, `parent`, `aktif`) VALUES
(1, 'Kipas gede', 'Kipas gede', 4, 2, 1),
(2, 'Gede', 'a', 4, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pages`
--

CREATE TABLE `m_pages` (
  `id_pages` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `cover_image` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `maps` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `vidio` text DEFAULT NULL,
  `url` text NOT NULL,
  `slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_pages`
--

INSERT INTO `m_pages` (`id_pages`, `title`, `cover_image`, `deskripsi`, `maps`, `image`, `vidio`, `url`, `slug`) VALUES
(4, 'Kipas Gede', '1662137481_carousel-1.jpg', '<p>hehe gede kipase gede<br></p>', '<div class=\"mapouter\"><div class=\"gmap_canvas\"><iframe width=\"600\" height=\"500\" id=\"gmap_canvas\" src=\"https://maps.google.com/maps?q=wajak&t=&z=13&ie=UTF8&iwloc=&output=embed\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\"></iframe><a href=\"https://fmovies-online.net\">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href=\"https://www.embedgooglemap.net\">google maps embed api</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>', NULL, NULL, 'pages/kipas-gede', 'kipas-gede');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_profil_app`
--

CREATE TABLE `m_profil_app` (
  `id_profil_app` int(11) NOT NULL,
  `nama` text NOT NULL,
  `logo` text NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `tiktok` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `whatsapp` text DEFAULT NULL,
  `telegram` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_profil_app`
--

INSERT INTO `m_profil_app` (`id_profil_app`, `nama`, `logo`, `favicon`, `no_telp`, `email`, `facebook`, `instagram`, `tiktok`, `youtube`, `whatsapp`, `telegram`) VALUES
(1, 'Kawipin', '1662113155_logo-esto.png', '1662113299_logo-esto.ico', '+818-0331-9221', 'coba@mail.com', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_vidio`
--

CREATE TABLE `m_vidio` (
  `id_vidio` int(11) NOT NULL,
  `embed` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_vidio`
--

INSERT INTO `m_vidio` (`id_vidio`, `embed`) VALUES
(1, 'assadasdsa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', NULL, '$2y$10$qQ5IKtg0FQtL5M73zN7IGuEqhQC2j/Kz5tllPvxtzURl6n0TEcYzC', NULL, '2022-08-31 20:31:24', '2022-08-31 20:31:24'),
(3, 'angga', 'angga@mail.com', NULL, '$2y$10$OiuaaxdyFhcvR7yitkX50e088PT/0VIksBFgBUeof52ij5VJ.q7/m', NULL, '2022-09-04 00:18:09', '2022-09-04 00:18:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_foto`
--
ALTER TABLE `m_foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indeks untuk tabel `m_galery`
--
ALTER TABLE `m_galery`
  ADD PRIMARY KEY (`id_galery`);

--
-- Indeks untuk tabel `m_kritik_saran`
--
ALTER TABLE `m_kritik_saran`
  ADD PRIMARY KEY (`id_kritik_saran`);

--
-- Indeks untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `m_pages`
--
ALTER TABLE `m_pages`
  ADD PRIMARY KEY (`id_pages`);

--
-- Indeks untuk tabel `m_profil_app`
--
ALTER TABLE `m_profil_app`
  ADD PRIMARY KEY (`id_profil_app`);

--
-- Indeks untuk tabel `m_vidio`
--
ALTER TABLE `m_vidio`
  ADD PRIMARY KEY (`id_vidio`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_foto`
--
ALTER TABLE `m_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `m_galery`
--
ALTER TABLE `m_galery`
  MODIFY `id_galery` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_kritik_saran`
--
ALTER TABLE `m_kritik_saran`
  MODIFY `id_kritik_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_pages`
--
ALTER TABLE `m_pages`
  MODIFY `id_pages` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_profil_app`
--
ALTER TABLE `m_profil_app`
  MODIFY `id_profil_app` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_vidio`
--
ALTER TABLE `m_vidio`
  MODIFY `id_vidio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
