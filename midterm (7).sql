-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2025 at 12:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midterm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_email`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'spich4', 'spich4@gmail.com', '$2y$12$Mb/vdSuXa8p81owq.uytV.PjPr3ncR9p.vtix4UhOBXEquJicWt3y', '2025-07-10 09:59:29', '2025-07-10 09:59:29', NULL);

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
(4, '2025_07_03_161758_create_shop_table', 1),
(5, '2025_07_03_162135_create_product_table', 1),
(6, '2025_07_03_164330_create_orders_table', 1),
(7, '2025_07_03_171249_create_order_item_table', 1),
(8, '2025_07_03_173050_create_admin_table', 1),
(9, '2025_07_06_081537_create_product_images_table', 1),
(10, '2025_07_07_084759_add_address_to_users_table', 1),
(11, '2025_06_09_123401_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderitem_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderitem_id`, `order_id`, `product_id`, `quantity`, `price`, `date_created`, `date_updated`) VALUES
(1, 1, 2, 1, 80.00, '2025-07-07 20:19:44', '2025-07-07 20:19:44'),
(2, 2, 4, 1, 60.00, '2025-07-08 09:23:11', '2025-07-08 09:23:11'),
(3, 3, 1, 1, 50.00, '2025-07-08 11:28:13', '2025-07-08 11:28:13'),
(4, 4, 6, 1, 99.00, '2025-07-08 16:00:59', '2025-07-08 16:00:59'),
(5, 5, 3, 1, 800.00, '2025-07-08 17:26:18', '2025-07-08 17:26:18'),
(6, 6, 7, 1, 180.00, '2025-07-08 17:47:45', '2025-07-08 17:47:45'),
(7, 7, 1, 1, 80.00, '2025-07-08 17:49:14', '2025-07-08 17:49:14'),
(8, 8, 1, 1, 80.00, '2025-07-10 09:26:51', '2025-07-10 09:26:51'),
(9, 9, 7, 1, 180.00, '2025-07-10 16:55:34', '2025-07-10 16:55:34'),
(10, 10, 3, 1, 800.00, '2025-07-10 19:27:54', '2025-07-10 19:27:54'),
(11, 11, 9, 1, 150.00, '2025-07-11 04:39:28', '2025-07-11 04:39:28'),
(12, 12, 7, 1, 180.00, '2025-07-11 10:09:04', '2025-07-11 10:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Confirmed','Rejected') NOT NULL DEFAULT 'Pending',
  `delivery_address` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`, `delivery_address`, `date_created`, `date_updated`) VALUES
(1, 2, '2025-07-07 20:19:44', 80.00, 'Confirmed', 'No address provided', '2025-07-07 20:19:44', '2025-07-07 20:19:44'),
(2, 2, '2025-07-08 09:23:11', 60.00, 'Confirmed', 'No address provided', '2025-07-08 09:23:11', '2025-07-08 09:56:25'),
(3, 2, '2025-07-08 11:28:13', 50.00, 'Rejected', 'No address provided', '2025-07-08 11:28:13', '2025-07-08 11:32:41'),
(4, 3, '2025-07-08 16:00:59', 99.00, 'Rejected', 'No address provided', '2025-07-08 16:00:59', '2025-07-08 17:49:00'),
(5, 3, '2025-07-08 17:26:18', 800.00, 'Rejected', 'Phnom Penh', '2025-07-08 17:26:18', '2025-07-08 17:27:40'),
(6, 1, '2025-07-08 17:47:45', 180.00, 'Rejected', 'Phnom Penh', '2025-07-08 17:47:45', '2025-07-08 17:49:03'),
(7, 2, '2025-07-08 17:49:14', 80.00, 'Rejected', 'No address provided', '2025-07-08 17:49:14', '2025-07-08 18:09:01'),
(8, 2, '2025-07-10 09:26:51', 80.00, 'Rejected', 'Phnom Penh', '2025-07-10 09:26:51', '2025-07-10 09:41:09'),
(9, 5, '2025-07-10 16:55:34', 180.00, 'Rejected', 'Phnom Penh', '2025-07-10 16:55:34', '2025-07-10 16:56:43'),
(10, 1, '2025-07-10 19:27:54', 800.00, 'Confirmed', 'Phnom Penh', '2025-07-10 19:27:54', '2025-07-10 19:28:16'),
(11, 6, '2025-07-11 04:39:28', 150.00, 'Rejected', 'Phnom Penh', '2025-07-11 04:39:28', '2025-07-11 04:45:57'),
(12, 1, '2025-07-11 10:09:04', 180.00, 'Confirmed', 'Phnom Penh', '2025-07-11 10:09:04', '2025-07-11 10:09:37');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_images` varchar(255) DEFAULT NULL,
  `in_stock` int(11) NOT NULL DEFAULT 1,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_category`, `product_price`, `product_description`, `product_images`, `in_stock`, `shop_id`, `date_created`, `date_updated`) VALUES
(1, 'Orchid Necklace', 'necklaces', 80.00, '925 Sterling Silver Orchid Flower Necklace Pendant with 18\" Box Chain, Nickle Free Hypoallergenic for Sensitive Skin, Island Tropical Jewelry with Gift Box.', NULL, 1, 1, '2025-07-07 20:16:25', '2025-07-10 09:41:09'),
(2, 'Aphrodite Necklace', 'necklaces', 80.00, 'Aphrodite, the Goddess of Love and Beauty, is embodied in this gorgeous sterling silver, orchid, and ruby necklace. Everything about this piece has been hand fabricated. From piercing the petals from a sheet of silver, to forming them and soldering them together, to creating the bail and connections for the ruby teardrop. This piece is perfect for daily wear or for an evening out. Comes with an 18 inch sterling silver chain', NULL, 0, 1, '2025-07-07 20:18:32', '2025-07-07 20:19:44'),
(3, 'Metal Chain Bracelet Cuff', 'bracelets', 800.00, 'Sterling 925 silver metal chain bracelet cuff, using snap clasp.', NULL, 0, 2, '2025-07-07 20:22:14', '2025-07-10 19:27:54'),
(4, 'Athena Bracelet', 'bracelets', 60.00, 'A stunning array of natural stones—mother of pearl, aventurine, black and white agate, tiger’s eye, moonstone, and abalone shell—come together on a single silver bracelet, each one showcasing its unique beauty. The black antiqued silver and hammered texture bring a raw, unrefined edge to the piece, echoing Athena’s natural essence and highlighting the timeless allure of these stones. Materials: silver plated brass,  mother of pearl, aventurine, tiger eye stone, moonstone, agate, abalone shell Measurements: 178mm/7.00\" in length We use natural stone and each piece is distinct, with variations in color, clarity and inclusion patterns. These characteristics define each stone’s unique appearance.', NULL, 0, 1, '2025-07-07 21:56:02', '2025-07-08 09:23:11'),
(6, 'Modern Chatelaine', 'other', 99.00, 'Modern chatelaine to match with your outfit, sterling silver 925. Can be used as a keychain as well.', NULL, 1, 2, '2025-07-08 11:25:14', '2025-07-08 17:49:00'),
(7, 'Silver Niobe Ring', 'rings', 180.00, 'NIOBE ring is a solid structure that emerges from the stone, retaining its texture impressed. Its thick shape is cut at the corners and curves laterally in strong and harmonious lines.', NULL, 0, 2, '2025-07-08 16:48:39', '2025-07-11 10:09:04'),
(9, 'Heart Earrings', 'earrings', 150.00, 'The Petra earrings offer a polished silver-toned design, featuring an asymmetric heart-shaped silhouette, recalling Vivienne\'s affection for humanity and the planet. The piece offers a contrasting gold-tone orb motif in the centre, which represents tradition, encircled by the celestial rings of Saturn, representing the future.', NULL, 1, 1, '2025-07-10 16:58:32', '2025-07-11 04:45:57'),
(10, 'Flower Earrings', 'earrings', 350.00, 'Beautiful silver orchid flower earrings, made by hand with love.', NULL, 1, 2, '2025-07-10 19:29:48', '2025-07-10 19:29:48'),
(11, 'Cutie Earrings', 'earrings', 500.00, 'Diamond earrings for everyday wear', NULL, 1, 5, '2025-07-11 04:41:54', '2025-07-11 04:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'product-images/X6963g9br4TdOVFvW9O2QLlMJOc5W7nWqGySP2AA.jpg', '2025-07-07 13:16:25', '2025-07-07 13:16:25'),
(2, 1, 'product-images/lEvrHuJO2DnnKH3EesyYMbZ57yZYmt9Cv3kSMaYJ.jpg', '2025-07-07 13:16:25', '2025-07-07 13:16:25'),
(3, 2, 'product-images/ilS0rpUZvLXUEiQqv6JEZLCODU0PhcVWrMUWyoRZ.jpg', '2025-07-07 13:18:32', '2025-07-07 13:18:32'),
(4, 3, 'product-images/MIqmVrn8IHym4ECxwX9LBfUqv005WMx64alztCGt.png', '2025-07-07 13:22:14', '2025-07-07 13:22:14'),
(5, 4, 'product-images/0QwKQfHJQwYzLU1Sti3aULsztGnr4EkbzkGQL7EM.jpg', '2025-07-07 14:56:02', '2025-07-07 14:56:02'),
(7, 6, 'product-images/DOw2HuQ2rDplsJnHkwFeLJJKXgx07jS1X4ZRm4aY.jpg', '2025-07-08 04:25:14', '2025-07-08 04:25:14'),
(8, 7, 'product-images/IJvrQY1yAiIHbRhwPlEXPLSKrlQuR1qOxyjj2nUh.webp', '2025-07-08 09:48:39', '2025-07-08 09:48:39'),
(9, 7, 'product-images/EkhyMaFjvKrUvOKpLPQLi6ukdHts2WbCt9hk9lix.webp', '2025-07-08 09:48:39', '2025-07-08 09:48:39'),
(10, 7, 'product-images/fh9Xcf0jWb9Xz0qSTRJq1D7htwBW63qGft0dwkXv.webp', '2025-07-08 09:48:39', '2025-07-08 09:48:39'),
(12, 9, 'product-images/bbab5FjhkDhfr5yBCJAzknni5Stvc4hR1th65UtO.jpg', '2025-07-10 09:58:32', '2025-07-10 09:58:32'),
(13, 9, 'product-images/ILTArpUu1TIrg7BAAQzXbeXFZoOk4VCVIO7xzZI1.jpg', '2025-07-10 09:58:32', '2025-07-10 09:58:32'),
(17, 10, 'product-images/cDSofRM5Jd1M9M6LFfQXKHCFYfGcTjAgCnb4W6HF.jpg', '2025-07-10 12:29:48', '2025-07-10 12:29:48'),
(18, 10, 'product-images/LAKzHR7pW0bwdWumcqq1DZv8nZ017keTf8YH59eP.jpg', '2025-07-10 12:29:48', '2025-07-10 12:29:48'),
(19, 10, 'product-images/2vyagQ7fXLZgGjTHFnqOBLn8zdbnNk8QvUmKCfDi.jpg', '2025-07-10 12:29:48', '2025-07-10 12:29:48'),
(21, 11, 'product-images/g5f6h4yXps9yv1ljBhfYixPDt3YC2jeKJgZqgTGQ.png', '2025-07-10 21:41:54', '2025-07-10 21:41:54');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GOAJ4IT4uuIsdW6dkYCGhVObgxZPxraRi9ktEmWR', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakVwSWNoSDFwZGhRUWFJS0FkOUg3Vzc0WTlWbDdWSHc3SUVHejFUVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9jYXJ0Ijt9fQ==', 1752228676);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `shop_email` varchar(100) NOT NULL,
  `shop_phonenumber` varchar(20) NOT NULL,
  `shop_address` varchar(255) NOT NULL,
  `shop_description` text DEFAULT NULL,
  `shop_profilepic` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `user_id`, `shop_name`, `shop_email`, `shop_phonenumber`, `shop_address`, `shop_description`, `shop_profilepic`, `date_created`, `date_updated`) VALUES
(1, 1, 'Hanni\'s Shop', 'hannisshop@gmail.com', '011 111 112', 'Seoul, South Korea', 'Welcome to your new favorite corner of the internet, where every piece of jewelry feels like a fairytale come true! 💖🌸   We’re a Korean-owned shop full of dreamy, dainty, and delightfully pretty things.\r\n\r\n\r\nHandpicked with love for the soft-hearted. Wear a little magic. Share a little joy. Stay endlessly cute. 💌\r\n\r\n#WhimsyInEveryPiece', 'shop-pictures/XuPYcFk6NdXtgnTIlMIkAuyXmbhDczuERz5BXaTp.png', '2025-07-07 20:14:37', '2025-07-10 17:01:57'),
(2, 2, 'Steph Ateiler', 'stephatelier@gmail.com', '022 222 223', 'Phnom Penh', 'We craft silver jewelry for those who break molds and blur boundaries. Inspired by avant-garde art and modern rebellion, each piece is a statement—raw, refined, and radically unique. Wear your edge. Own your story.', 'shop-pictures/iNTuVBlap7tcmNkFmEI5fIH4VnehRJNJDxhZoMTL.jpg', '2025-07-07 20:21:00', '2025-07-08 16:54:37'),
(3, 3, 'Linh\'s Jewels', 'linhsjewels@gmail.com', '033 333 334', 'Phnom Penh', NULL, NULL, '2025-07-08 18:22:01', '2025-07-08 18:22:01'),
(4, 5, 'TIS GOLD', 'tisgold@gmail.com', '055 555 556', 'Phnom Penh, Cambodia', 'We sell 24k carat Labubu here, cannot find anywhere else for a good price!', NULL, '2025-07-10 16:53:34', '2025-07-10 16:53:34'),
(5, 6, 'Ratana Shop', 'ratanashop@gmail.com', '066 666 666', 'Phnom Penh, Cambodia', 'jndskfvnds', NULL, '2025-07-11 04:40:53', '2025-07-11 04:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profilepic` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profilepic`, `phonenumber`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hanni Pham', 'hpham@gmail.com', 'avatars/aImJ6QOxOwuaNBTmojRjxiIwQPeNjWOpTuOrilAB.jpg', '011 111 111', 'Phnom Penh', NULL, '$2y$12$Sxng.DA56vvuiJmX84Wkv.9xkDlXZ1VWqTRES3SAGiDCCvTqN.HMm', '48aG627LwfXKNvpDLrLgHv8h9hMwtKZjemk4XO23Bex3ylJgZ0x31uRA0MLD', '2025-07-07 13:13:51', '2025-07-08 10:47:02'),
(2, 'Stephanie Lu', 'slu@gmail.com', 'avatars/ERszBadQXh1QjhiDtkaIF2gEH1tEwRjRvz6id2jh.jpg', '022 222 222', 'Phnom Penh', NULL, '$2y$12$vwlMv6cm0RnlvpOFFdWSyOiBi1mbw2zkFpYV56POdLKBjkW/Jflm.', 'py16ExhPn6R1oBDAZ3905jGmNoMlJqMbq0oaFQCbefdFJts8Ry6IFT5IZ0QJ', '2025-07-07 13:19:20', '2025-07-08 11:08:39'),
(3, 'Chealinh Channnn', 'cchan@gmail.com', 'avatars/Wtz3QqYSoRakKPsgm43ppoyNtPETBm0mrAWdmjfz.jpg', '033 333 333', 'Phnom Penh', NULL, '$2y$12$d4Hhq0mib06JLamo3Ej.P.TtsVYyeoKUpVArB.2eSte3BAlt5sng6', '2ffmkP4aWYNhRxY79tifD2TM95sRg8Eu1tiEPEd5vJZSsK0WJbmBFUc8Gnv7', '2025-07-08 04:42:19', '2025-07-08 10:20:13'),
(4, 'Moneath Phan', 'mphan@gmail.com', 'avatars/tmA9mPVEBC38sUOGHo8CxtodKK5r8r9KWJokujEY.jpg', '044 444 444', 'Phnom Penh', NULL, '$2y$12$DM6iqVDTSBy6.5/qkXuQKu0P97bZ2xjpeoDrv3L574ze5qf4NW/uC', 'SDrsSsgnqqVY5iTEOY6GcazQLzJlzw6DFMsM8XBoEHRwsDyRATRrP5xmyHpG', '2025-07-08 10:22:48', '2025-07-08 10:28:47'),
(5, 'Tisa Song', 'tsong@gmail.com', NULL, '055 555 555', 'Phnom Penh', NULL, '$2y$12$pKPTZAYOdEgxFEibCOvwDO6Gz1nxnPLqZQj59sAoobe5nJRwD37jq', NULL, '2025-07-10 09:51:24', '2025-07-10 09:51:24'),
(6, 'Ratana Soth', 'rsoth@gmail.com', 'avatars/S7KOVVHWdtPDLx1C7ixtPu7DrIK62ScWHuU3Wp5a.jpg', '066 666 633', 'Phnom Penh', NULL, '$2y$12$891EaxzBudhJnBrxrJcqie.f463fn3QJnH/E/2OJ4DvdENBxRXdza', NULL, '2025-07-10 21:37:37', '2025-07-10 21:38:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_admin_username_unique` (`admin_username`),
  ADD UNIQUE KEY `admin_admin_email_unique` (`admin_email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `orderitem_order_id_foreign` (`order_id`),
  ADD KEY `orderitem_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `shop_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderitem_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderitem_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
