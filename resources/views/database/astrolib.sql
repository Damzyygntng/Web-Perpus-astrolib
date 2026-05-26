-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 02:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astrolib`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `halaman` int(11) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `dipinjam` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `halaman`, `isbn`, `sinopsis`, `stok`, `cover`, `created_at`, `updated_at`, `kategori_id`, `dipinjam`) VALUES
(2, 'Jangan Takut Bermimpi', 'Fakrun Nisa Haffeza', 'Bee Media Pustaka', '2016', 119, '9786026227591', 'Buku ini merupakan kumpulan kisah motivasi yang mengajak pembaca untuk berani memiliki impian besar. Isinya menekankan bahwa rintangan hidup bukanlah alasan untuk berhenti, melainkan ujian untuk memperkuat tekad dalam meraih cita-cita yang diinginkan.', 5, 'gambar/jangan_takut.png', '2026-05-03 06:57:57', '2026-05-04 10:08:05', 1, 0),
(3, 'Perahu Kertas', 'Dewi Lestari', 'Bentang Pustaka', '2009', 44, '9789791227780', 'Kisah tentang Kugy (penulis dongeng yang eksentrik) dan Keenan (pelukis berbakat yang tertekan) yang saling jatuh cinta namun terhalang oleh ego dan keadaan. Setelah bertahun-tahun terpisah dan mencoba menjalani hidup masing-masing, mereka akhirnya menyadari bahwa impian dan perasaan mereka selalu membawa mereka kembali satu sama lain.', 4, 'gambar/perahu_kertas.png', '2026-05-04 09:00:04', '2026-05-09 07:14:25', 1, 0),
(4, 'Ayah Ini Arahnya Kemana?', 'Khoirul Trian', 'Gradien Mediatama', '2021', 188, '9786022081982', 'buku ini berisi kumpulan surat, refleksi, dan percakapan imajiner antara seorang anak dan sosok ayahnya. Isinya fokus pada rasa kehilangan, kerinduan, dan bagaimana sosok ayah tetap menjadi kompas atau petunjuk arah bagi seorang anak dalam menjalani hidup, meski sang ayah mungkin sudah tidak ada lagi di sisinya.', 2, 'gambar/ayh.png', '2026-05-04 09:06:33', '2026-05-07 08:38:52', 1, 0),
(5, 'Laut Bercerita', 'Leila S. Chudori', 'Kepustakaan Populer Gramedia', '2017', 394, '9786024246945', 'Menceritakan tentang Biru Laut, seorang mahasiswa yang aktif dalam gerakan perlawanan di era Orde Baru. Ia bersama teman-temannya ditangkap, disiksa, dan hilang secara misterius. Bagian ini penuh dengan perjuangan, persahabatan, dan cinta tipis yang sangat berkesan antara Laut dan Anjani.', 5, 'gambar/laut.jpg', '2026-05-04 09:16:36', '2026-05-04 10:10:43', 1, 0),
(6, 'Pulang Pergi', 'Tere Liye', 'Sabak Grip', '2021', 417, '9786239554521', 'Bujang dijebak dalam sebuah perjodohan politik dengan putri penguasa ekonomi bawah tanah Rusia. Acara pertunangan yang seharusnya damai berubah menjadi medan tempur karena serangan musuh besar. Bersama Thomas, Salonga, dan Junior, Bujang harus bertarung melintasi negara untuk bertahan hidup dan menghancurkan konspirasi global yang mengancam mereka.\n', 5, 'gambar/pulang.jpeg', '2026-05-04 09:24:05', '2026-05-04 10:11:36', 1, 0),
(7, 'Menanti Restu Langit', 'Makhasin', 'Deepublish', '2020', 67, '9786230214967', 'Novel \"Menanti Restu Langit\" karya Makhasin merupakan kisah inspiratif tentang perjuangan seseorang dalam mengenali jati diri dan mengubah nasib di tengah keterbatasan. Melalui narasi yang menyentuh, buku ini menekankan bahwa meski manusia tidak ada yang sempurna, tekad yang kuat dan semangat membara adalah kunci untuk melampaui kondisi ekonomi keluarga demi meraih masa depan yang lebih baik.\n', 4, 'gambar/menanti.jpg', '2026-05-04 09:25:55', '2026-05-17 19:26:29', 1, 0),
(8, 'Koala Kumal', 'Raditya Dika', 'GagasMedia', '2015', 250, ' 9789797807696', 'Buku Koala Kumal merupakan kumpulan komedi putar yang menceritakan pengalaman pribadi Raditya Dika tentang berbagai fase patah hati. Melalui analogi seekor koala yang merasa asing saat kembali ke sarangnya yang telah berubah, Raditya menggambarkan bagaimana seseorang bisa berubah menjadi \"kumal\" dan berbeda setelah mengalami luka hati yang hebat. Ceritanya berfokus pada momen-momen pahit saat dikhianati, sulitnya proses untuk bangkit kembali atau move on, hingga pertemuan-pertemuan konyol dengan orang baru yang dibungkus dengan banyolan khas yang membuat pembaca tertawa sekaligus merasa iba.\n', 5, 'gambar/Koala.png', '2026-05-04 09:29:41', '2026-05-04 19:40:50', 2, 0),
(9, 'Tes Kemampuan Akademik', 'Tim Tentor Kompeten', 'Pixelindo', '2024', 600, '9786235479996', NULL, 5, 'gambar/tka.jpeg', '2026-05-04 09:36:20', '2026-05-04 19:48:03', 3, 0),
(10, 'Berdamai dengan Diri Sendiri', 'Muthia Sayekti', 'Psikologi Corner', '2017', 212, '9786025014123', 'Buku ini membahas tentang cara menghadapi musuh terbesar dalam hidup, yaitu diri kita sendiri. Penulis mengajak pembaca untuk berhenti menyalahkan diri atas kegagalan masa lalu dan mulai menerima segala kekurangan yang dimiliki. Melalui pendekatan psikologi yang ringan, buku ini menjelaskan pentingnya berdamai dengan rasa takut, penyesalan, dan rasa tidak percaya diri agar kita bisa hidup lebih tenang dan bahagia tanpa terus-menerus membandingkan diri dengan orang lain.', 2, 'gambar/images.jpg', '2026-05-04 09:39:21', '2026-05-17 19:46:44', 4, 0),
(11, 'Spiritual Gems of Islam', 'Jamal Rahman', 'Psikologi CornerRene Islam', '2021', 312, '9786236083215', 'Buku ini berisi kumpulan \'permata\' atau sari pati ajaran Islam yang diambil dari ayat Al-Quran, hadis, serta kisah-kisah kebijaksanaan dari para sufi dan tokoh besar Islam (seperti Rumi dan Sa\'di). Penulis tidak membahas aturan hukum (fikih) yang kaku, melainkan fokus pada bagaimana Islam bisa menenangkan hati dan mencerahkan pikiran. Isinya sangat universal, membahas tentang cinta, kasih sayang, kesabaran, dan cara menemukan kedamaian batin di tengah dunia yang modern dan sibuk.', 5, 'gambar/islam.png', '2026-05-04 09:45:26', '2026-05-04 20:05:15', 5, 0),
(12, 'The Power Of Habit', 'Charles Duhigg', 'Kepustakaan Populer Gramedia', '2013', 424, '9789799105479', 'Buku ini mengungkap sains di balik kebiasaan manusia melalui konsep \'Lingkaran Kebiasaan\' (Habit Loop), yang terdiri dari Tanda (pemicu), Rutinitas (tindakan), dan Ganjaran (hasil). Charles Duhigg menjelaskan bahwa kita tidak bisa menghapus kebiasaan buruk sepenuhnya, namun kita bisa menggantinya dengan memahami cara kerja pola tersebut di otak. Dengan mengubah \'kebiasaan inti\' (keystone habits), seseorang dapat menciptakan efek domino positif untuk mengubah hidup dan produktivitas secara drastis, baik dalam lingkup pribadi maupun bisnis.', 4, 'gambar/Habit.png', '2026-05-04 18:38:16', '2026-05-17 20:57:16', 2, 0),
(13, 'Educated Terdidik', 'Tara Westover', 'Gramedia Pustaka Utama', '2019', 480, '9789799105479', 'Buku ini adalah sebuah memoar luar biasa tentang seorang wanita yang lahir dari keluarga penganut paham kelangsungan hidup (survivalist) di pegunungan Idaho. Tara tidak pernah menginjakkan kaki di sekolah, tidak memiliki akta kelahiran, dan tidak pernah mengunjungi dokter hingga ia dewasa.\nMeskipun tumbuh dalam isolasi dan kekerasan, Tara belajar secara otodidak agar bisa masuk universitas. Buku ini mengisahkan perjuangannya mengejar pendidikan hingga mencapai gelar doktor dari Universitas Cambridge, sembari menghadapi konflik batin antara keinginannya untuk maju dan kesetiaannya kepada keluarganya yang keras.', 5, 'gambar/Educated.png', '2026-05-04 18:41:06', '2026-05-04 19:44:09', 2, 0),
(14, 'Kisah, Perjuangan, & Inspirasi B.J. Habibie', 'Weda S. Atma', 'Checklist', '2017', 208, '9786026763440', 'Buku biografi inspiratif ini merangkum perjalanan hidup Bacharuddin Jusuf Habibie, mulai dari masa kecilnya di Parepare, perjuangan menuntut ilmu di Jerman, hingga kontribusi besarnya bagi dunia kedirgantaraan internasional dan Indonesia.', 5, 'gambar/habibie.png', '2026-05-04 18:44:47', '2026-05-04 19:45:09', 2, 0),
(15, 'Mindset', 'Carol S. Dweck, Ph.D.', 'Baca', '2017', 400, '9786026486073', 'Melalui buku ini, Dweck menunjukkan bagaimana pola pikir tersebut memengaruhi hampir setiap aspek kehidupan—mulai dari cara mendidik anak, memimpin perusahaan, hingga menjalin hubungan. Pesan utamanya adalah kita bisa mengubah pola pikir untuk mencapai potensi maksimal.', 5, 'gambar/mindset.png', '2026-05-04 18:46:53', '2026-05-04 19:47:25', 2, 0),
(16, 'Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'Grasindo', '2018', 256, '9786024526986', 'Buku ini menantang tren \"positif berlebihan\" dengan argumen bahwa kunci kebahagiaan adalah berhenti memedulikan segalanya. Mark Manson mengajak kita untuk hanya peduli pada hal-hal yang benar-benar penting dan menerima kenyataan pahit bahwa hidup tidak selalu indah. Dengan gaya bahasa yang blak-blakan, buku ini mengajarkan cara mengelola ekspektasi dan menemukan ketenangan melalui penerimaan terhadap keterbatasan diri.', 5, 'gambar/bodoamat.png', '2026-05-04 18:49:13', '2026-05-04 19:47:04', 2, 0),
(17, 'Pendidikan Pancasila', 'Tedi Kholiluddin', 'Kemendikbudristek', '2023', 208, '9786231946126', NULL, 5, 'gambar/PPKN.png', '2026-05-04 18:55:09', '2026-05-04 19:48:41', 3, 0),
(18, 'Ekonomi', 'Alam S. dan Aristanti W.', 'Erlangga Group', '2022', 464, '9786232668270', NULL, 5, 'gambar/ekonomi.jpg', '2026-05-04 18:56:56', '2026-05-04 19:49:14', 3, 0),
(19, 'Informatika', 'Henry Pandia', 'Erlangga', '2023', 352, '9786232668218', NULL, 5, 'gambar/informatika.png', '2026-05-04 18:58:29', '2026-05-04 19:50:10', 3, 0),
(20, 'Kimia', 'Unggul Sudarmo', 'Erlangga', '2022', 384, '9786232668317', NULL, 5, 'gambar/kimia.png', '2026-05-04 19:00:13', '2026-05-04 19:50:26', 3, 0),
(21, 'Matematika', 'Dicky Susanto', 'Kemendikbudristek', '2021', 216, '9786022447917', NULL, 5, 'gambar/matematika.png', '2026-05-04 19:01:44', '2026-05-04 19:50:38', 3, 0),
(22, 'Gesture', 'Zaka Putra Ramdani', 'Anak Hebat Indonesia', '2020', 200, '9786232442436', 'Buku ini merupakan panduan praktis untuk memahami komunikasi non-verbal yang sering kali lebih jujur daripada kata-kata. Penulis membedah berbagai bentuk bahasa tubuh, mulai dari mikroekspresi wajah yang sekilas hingga gerakan tangan dan posisi duduk.', 5, 'gambar/gesture.jpg', '2026-05-04 19:04:50', '2026-05-04 19:53:19', 4, 0),
(23, 'Rahasia Melatih Pola Pikir', 'Jonathan Pratama', 'Liceria & Co.', '2023', 200, NULL, 'Buku ini fokus pada teknik praktis untuk membangun pola pikir yang membangun (konstruktif). Penulis menawarkan metode untuk membantu pembaca melepaskan diri dari jebakan pikiran negatif, pesimisme, dan rasa putus asa. Inti pesannya adalah bagaimana mengubah cara pandang terhadap masalah agar lebih solutif, sehingga seseorang bisa tetap produktif dan tenang dalam menghadapi tekanan hidup sehari-hari.', 4, 'gambar/melatih polapikir.webp', '2026-05-04 19:09:18', '2026-05-17 20:09:57', 4, 0),
(24, 'Berani Tidak Disukai', 'Ichiro Kishimi', 'Gramedia Pustaka Utama', '2019', 352, '9786020633213', 'Buku ini menggunakan format dialog antara seorang pemuda dan seorang filsuf untuk menjelaskan ajaran psikologi Alfred Adler (salah satu dari tiga tokoh besar psikologi dunia bersama Freud dan Jung).', 5, 'gambar/berani.jpg', '2026-05-04 19:12:13', '2026-05-04 19:58:27', 4, 0),
(25, 'Apa yang Kita Pikirkan ketika Kita Sendirian', 'Desi Anwar', 'Gramedia Pustaka Utama', '2016', 248, '9786020333205', 'Buku ini merupakan kumpulan esai reflektif yang mengajak pembaca untuk berhenti sejenak dari hiruk-pikuk dunia dan merenung dalam kesendirian (solitude). Desi Anwar membagikan pemikirannya tentang berbagai hal sederhana dalam hidup—mulai dari menghargai waktu, memaknai kegagalan, hingga menemukan kebahagiaan dalam hal-hal kecil.', 5, 'gambar/motivasi.jpg', '2026-05-04 19:14:56', '2026-05-04 19:58:52', 4, 0),
(26, 'Kerja Kerja Kaya', 'Ir. Mahayana SR', 'Elex Media Komputindo', '2017', 184, '9786020448138', 'Buku ini merupakan kumpulan esai reflektif yang mengajak pembaca untuk berhenti sejenak dari hiruk-pikuk dunia dan merenung dalam kesendirian (solitude). Desi Anwar membagikan pemikirannya tentang berbagai hal sederhana dalam hidup—mulai dari menghargai waktu, memaknai kegagalan, hingga menemukan kebahagiaan dalam hal-hal kecil.', 2, 'gambar/kerjakaya.jpg', '2026-05-04 19:21:13', '2026-05-16 07:38:17', 4, 0),
(27, 'Spiritual Awakening', 'Mark Thurston, Ph.D.', 'Alvabet', '2012', 320, '9786029193633', 'Buku ini mengeksplorasi pemikiran dan ramalan Edgar Cayce, yang dikenal sebagai salah satu cenayang paling berpengaruh di zaman modern, mengenai kebangkitan spiritual di abad ke-21. Mark Thurston merangkum ajaran Cayce menjadi panduan praktis untuk memahami perubahan besar yang sedang terjadi di dunia saat ini.', 5, 'gambar/awekening.jpg', '2026-05-04 19:25:02', '2026-05-04 20:05:53', 5, 0),
(28, 'Perjalanan Spiritual', 'Maichel Sin', 'Deepublish', '2020', 110, '9786230213700', 'Buku ini merupakan sebuah karya yang ditujukan bagi para pencari jati diri. Isinya memandu pembaca untuk melakukan eksplorasi batin guna menemukan esensi diri yang sesungguhnya di balik label sosial atau identitas duniawi. Penulis mengajak pembaca memahami bahwa pengalaman spiritual bukan sekadar teori, melainkan sebuah perjalanan personal untuk mencapai kesadaran yang lebih dalam dan ketenangan sejati.', 5, 'gambar/perjalanan.jpg', '2026-05-04 19:27:13', '2026-05-04 20:06:09', 5, 0),
(29, 'Spiritual Enlightenment', 'Ikhwan Marzuqi', 'Elex Media Komputindo', '2018', 200, '9786020453347', 'Buku ini mengajak pembaca untuk mengenal, mencintai, dan menyayangi proses pencerahan spiritual dalam kehidupan sehari-hari. Berbeda dengan buku pengembangan diri yang teknis, karya ini lebih fokus pada aspek kecerdasan emosional dan spiritual.', 5, 'gambar/enlightment.jpg', '2026-05-04 19:29:02', '2026-05-04 20:06:40', 5, 0),
(30, 'Al-Qur\'an Al-Karim', 'Mushaf Standar Indonesia', 'Maghfirah, Diponegoro', '2015', 604, NULL, NULL, 5, 'gambar/alquran.jpg', '2026-05-04 19:33:35', '2026-05-04 20:07:02', 5, 0),
(31, 'Alkitab Edisi Studi', 'Lembaga Alkitab Indonesia', 'Maghfirah, Diponegoro', '2010', 2500, '9789794634059', NULL, 5, 'gambar/alkitab.jpg', '2026-05-04 19:35:20', '2026-05-04 20:07:21', 5, 0),
(33, 'Si Anak Pintar', 'Tere Liye', 'Republika Penerbit', '2018', 364, '9786025734502', 'mantep', 5, 'sipintar.jpg', '2026-05-16 06:00:47', '2026-05-16 06:26:07', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', '2026-05-03 06:52:16', '2026-05-03 06:52:16'),
(2, 'Nonfiksi', '2026-05-03 06:52:16', '2026-05-03 06:52:16'),
(3, 'Pelajaran', '2026-05-03 06:52:16', '2026-05-03 06:52:16'),
(4, 'Pengembangan diri', '2026-05-03 06:52:16', '2026-05-03 06:52:16'),
(5, 'Spiritual', '2026-05-03 06:52:16', '2026-05-03 06:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_pribadis`
--

CREATE TABLE `koleksi_pribadis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `koleksi_pribadis`
--

INSERT INTO `koleksi_pribadis` (`id`, `user_id`, `buku_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2026-05-17 08:02:55', '2026-05-17 08:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_23_130839_create_peminjaman_table', 1),
(5, '2026_04_28_125955_add_photo_to_users_table', 1),
(6, '2026_04_29_020412_add_role_to_users_table', 1),
(7, '2026_05_03_130718_create_bukus_table', 2),
(8, '2026_05_03_134254_create_kategoris_table', 3),
(9, '2026_05_03_135946_add_kategori_id_to_bukus_table', 4),
(10, '2026_05_05_011757_create_ulasans_table', 4),
(11, '2026_05_06_063703_add_status_to_peminjaman_table', 5),
(12, '2026_05_06_071412_add_buku_id_to_peminjaman_table', 6),
(13, '2026_05_07_143413_add_alasan_to_peminjamen_table', 7),
(14, '2026_05_11_124349_add_pengembalian_to_peminjamen_table', 8),
(15, '2026_05_11_144406_fix_status_pengembalian_enum', 9),
(16, '2026_05_12_012206_add_denda_to_peminjaman_table', 10),
(17, '2026_05_14_130614_create_pengajuan_bukus_table', 11),
(18, '2026_05_16_141444_add_dipinjam_to_bukus_table', 12),
(19, '2026_05_17_133611_create_koleksi_pribadis_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `alasan_penolakan` text DEFAULT NULL,
  `status_pengembalian` enum('belum','menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `denda` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `judul_buku`, `tanggal_pinjam`, `tanggal_kembali`, `created_at`, `updated_at`, `status`, `buku_id`, `alasan_penolakan`, `status_pengembalian`, `denda`) VALUES
(6, 1, 'Koala Kumal', '2026-05-06', '2026-05-12', '2026-05-06 05:10:00', '2026-05-07 05:32:34', 'ditolak', 8, NULL, 'menunggu', 0),
(7, 1, 'Laut Bercerita', '2026-05-07', '2026-05-12', '2026-05-07 05:16:45', '2026-05-07 08:18:23', 'ditolak', 5, 'karna anda jelek', 'menunggu', 0),
(8, 1, 'Ayah Ini Arahnya Kemana?', '2026-05-07', '2026-05-11', '2026-05-07 08:38:38', '2026-05-11 07:51:16', 'disetujui', 4, NULL, 'ditolak', 0),
(11, 1, 'Perahu Kertas', '2026-05-08', '2026-05-11', '2026-05-07 18:55:15', '2026-05-07 18:55:54', 'ditolak', 3, 'km jelek', 'menunggu', 0),
(12, 1, 'Pulang Pergi', '2026-05-08', '2026-05-11', '2026-05-07 19:08:34', '2026-05-07 19:09:10', 'ditolak', 6, 'LU JELEK AJG', 'menunggu', 0),
(14, 1, 'Spiritual Gems of Islam', '2026-05-09', '2026-05-11', '2026-05-09 07:14:00', '2026-05-09 07:14:35', 'ditolak', 11, 'gatau', 'menunggu', 0),
(15, 1, 'Kerja Kerja Kaya', '2026-05-11', '2026-05-22', '2026-05-11 06:53:39', '2026-05-16 08:33:25', 'disetujui', 26, 'kamu aneh', 'ditolak', 0),
(18, 7, 'Berdamai dengan Diri Sendiri', '2026-05-18', '2026-05-19', '2026-05-17 19:45:54', '2026-05-17 19:56:10', 'disetujui', 10, NULL, 'disetujui', 0),
(19, 7, 'Spiritual Gems of Islam', '2026-05-18', '2026-05-25', '2026-05-17 19:55:55', '2026-05-17 20:12:30', 'ditolak', 11, 'yayaya', 'belum', 0),
(20, 7, 'Spiritual Gems of Islam', '2026-05-18', '2026-05-25', '2026-05-17 19:55:56', '2026-05-17 19:55:56', 'menunggu', 11, NULL, 'belum', 0),
(21, 7, 'Rahasia Melatih Pola Pikir', '2026-05-18', '2026-05-25', '2026-05-17 20:09:47', '2026-05-17 20:10:32', 'disetujui', 23, NULL, 'disetujui', 0),
(22, 7, 'The Power Of Habit', '2026-05-18', '2026-05-25', '2026-05-17 20:56:58', '2026-05-17 20:57:57', 'disetujui', 12, NULL, 'disetujui', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_buku`
--

CREATE TABLE `pengajuan_buku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `status` enum('menunggu','disetujui','ditolak') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `user_id`, `buku_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
(8, 1, 3, 5, 'saya suka bukunya', '2026-05-11 19:54:17', '2026-05-11 19:54:17'),
(9, 7, 23, 5, 'Mantep bukunya keren', '2026-05-17 20:53:21', '2026-05-17 20:53:21'),
(10, 7, 12, 5, 'Bukunya bagus', '2026-05-17 20:58:42', '2026-05-17 20:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `lokasi` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `lokasi`, `remember_token`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'Dandy Ganteng', 'dfirmansyah625@gmail.com', NULL, '$2y$12$VUBDKwERD4CI3mFZ.43dJ.OV3aGs4N.jbV0ivvhTukSN4pjYTVwly', 'user', 'Jakarta', NULL, '2026-05-03 01:01:55', '2026-05-07 19:08:10', 'jpCG9HRI8ytncpVXbPACWkt7tV8tvehfycldc86B.jpg'),
(2, 'astrodann', 'astrodann@gmail.com', NULL, '$2y$12$54SdA.z1Ju6HkANVhy6WSe1QZNB6dyrJneAoZKqJYSvJ60x9Sy2ju', 'petugas', 'Jakarta', NULL, '2026-05-03 01:04:47', '2026-05-03 01:04:47', NULL),
(3, 'admin', 'admin@gmail.com', NULL, '$2y$12$zyVgdw/ajfWKJJWH3bJ8feTVnrYAsOS2EiOs4s/64rt7ZrqlnvtKi', 'admin', 'Jakarta', NULL, '2026-05-03 01:05:55', '2026-05-03 01:05:55', NULL),
(6, 'jet12', 'jet12@gmail.com', NULL, '$2y$12$QFOSbvPf44EzNrRNc1itu.zQbH3x7mkFqGmQX8OA64fXXLJBfYFku', 'petugas', NULL, NULL, '2026-05-14 05:27:02', '2026-05-14 05:27:02', NULL),
(7, 'Dandskuyy', 'dandy@gmail.com', NULL, '$2y$12$eVKi2ffmXsSv7aymA2FUH.9Zs6IfNSC0vv0SqvCEjj0bru99X/n7e', 'user', 'Bogor', NULL, '2026-05-17 19:25:41', '2026-05-17 19:25:41', NULL),
(8, 'Dandy keren', 'laravel@gmail.com', NULL, '$2y$12$RgxgaDVuC5SeydBukp//H.gFaGNPfItb1MnIudPZgO1w75KXzY3Ma', 'petugas', NULL, NULL, '2026-05-17 21:02:22', '2026-05-17 21:02:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bukus_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `koleksi_pribadis_user_id_foreign` (`user_id`),
  ADD KEY `koleksi_pribadis_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengajuan_buku`
--
ALTER TABLE `pengajuan_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulasans_user_id_foreign` (`user_id`),
  ADD KEY `ulasans_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengajuan_buku`
--
ALTER TABLE `pengajuan_buku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `bukus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `koleksi_pribadis`
--
ALTER TABLE `koleksi_pribadis`
  ADD CONSTRAINT `koleksi_pribadis_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `koleksi_pribadis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD CONSTRAINT `ulasans_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
