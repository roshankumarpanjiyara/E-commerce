-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4000
-- Generation Time: Oct 30, 2022 at 03:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super.admin@gmail.com', '2022-10-09 10:05:03', '$2y$10$wEYoc/FCRd5RsLCXn5YWceKt/mqVVq6V2XWbaoksiUJbfSvSvNjxG', 1, NULL, NULL, NULL, '2022-10-09 10:05:03', '2022-10-09 10:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_img`, `title`, `type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'storage/banners/banner_vert_1746680739920691.png', 'Make your Breakfast<br> Healthy and Easy', 1, NULL, 1, '2022-10-14 10:52:42', '2022-10-14 10:52:42'),
(3, 'storage/banners/banner_hori_1746680814776657.png', 'Make your Breakfast<br> Healthy and Easy', 2, 'Shop Now', 1, '2022-10-14 10:53:53', '2022-10-14 11:16:17'),
(4, 'storage/banners/banner_hori_1746680929673493.png', 'Make your Breakfast<br> Healthy and Easy', 2, NULL, 1, '2022-10-14 10:55:41', '2022-10-14 10:55:41'),
(5, 'storage/banners/banner_hori_1746680960717883.png', 'Make your Breakfast<br> Healthy and Easy', 2, NULL, 1, '2022-10-14 10:56:11', '2022-10-14 11:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `created_by`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'nike', 'Super Admin', 'storage/brands/brand_1746737610500274.png', '2022-10-09 10:07:03', '2022-10-15 01:56:36'),
(2, 'Roadster', 'roadster', 'Super Admin', 'storage/brands/brand_1746736606387853.jpg', '2022-10-15 01:40:39', '2022-10-15 01:40:39'),
(3, 'HRX', 'hrx', 'Super Admin', 'storage/brands/brand_1746737630969686.png', '2022-10-15 01:56:56', '2022-10-15 01:56:56'),
(4, 'Allen Solly', 'allen-solly', 'Super Admin', 'storage/brands/brand_1746737647371609.png', '2022-10-15 01:57:11', '2022-10-15 01:57:11'),
(5, 'Levi\'s', 'levis', 'Super Admin', 'storage/brands/brand_1746737665335013.png', '2022-10-15 01:57:29', '2022-10-15 01:57:29'),
(6, 'Puma', 'puma', 'Super Admin', 'storage/brands/brand_1746737681978934.png', '2022-10-15 01:57:44', '2022-10-15 01:57:44'),
(7, 'H&M', 'hm', 'Super Admin', 'storage/brands/brand_1746737695758888.png', '2022-10-15 01:57:58', '2022-10-15 01:57:58'),
(8, 'Jockey', 'jockey', 'Super Admin', 'storage/brands/brand_1746737709368214.png', '2022-10-15 01:58:11', '2022-10-15 01:58:11'),
(9, 'U.S. Polo', 'us-polo', 'Super Admin', 'storage/brands/brand_1746737725929317.png', '2022-10-15 01:58:26', '2022-10-15 01:58:26'),
(10, 'Lee', 'lee', 'Super Admin', 'storage/brands/brand_1746737744957965.png', '2022-10-15 01:58:44', '2022-10-15 01:58:44'),
(11, 'Here & Now', 'here-now', 'Super Admin', 'storage/brands/brand_1746737838256433.png', '2022-10-15 02:00:13', '2022-10-15 02:00:13'),
(12, 'Wrogn', 'wrogn', 'Super Admin', 'storage/brands/brand_1746737851497703.jpg', '2022-10-15 02:00:26', '2022-10-15 02:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_by`, `meta_title`, `meta_description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 'Super Admin', NULL, NULL, 'storage/category/category_1746651694495162.png', '2022-10-09 10:07:30', '2022-10-14 03:11:00'),
(2, 'Women', 'women', 'Super Admin', NULL, NULL, 'storage/category/category_1746651712482926.png', '2022-10-14 03:05:39', '2022-10-14 03:11:18'),
(3, 'Kids', 'kids', 'Super Admin', NULL, NULL, 'storage/category/category_1746651681342116.png', '2022-10-14 03:06:01', '2022-10-14 03:10:48'),
(4, 'Home & Living', 'home-living', 'Super Admin', NULL, NULL, 'storage/category/category_1746651665965944.png', '2022-10-14 03:06:46', '2022-10-14 03:10:33'),
(5, 'Beauty', 'beauty', 'Super Admin', NULL, NULL, 'storage/category/category_1746651531873921.png', '2022-10-14 03:08:25', '2022-10-14 03:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `validity` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `discount`, `validity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NEW_USER', 10, '2022-10-29', 1, '2022-10-28 06:56:25', '2022-10-28 06:56:25'),
(2, 'FREEDOM', 5, '2022-10-31', 0, '2022-10-28 07:02:36', '2022-10-29 01:32:04'),
(3, 'HELLO', 20, '2022-11-01', 1, '2022-10-28 07:08:33', '2022-10-28 07:08:33'),
(4, 'GOOD', 10, '2022-10-29', 1, '2022-10-28 07:41:59', '2022-10-28 07:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 3, 'Howrah', '2022-10-29 08:24:49', '2022-10-29 08:24:49'),
(3, 2, 'Patna', '2022-10-29 08:37:33', '2022-10-29 08:37:33'),
(4, 3, 'Kolkata', '2022-10-29 09:43:03', '2022-10-29 09:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_09_16_083843_create_sessions_table', 1),
(7, '2022_09_16_085135_create_admins_table', 1),
(8, '2022_09_17_141705_create_roles_table', 1),
(9, '2022_09_17_142028_create_permissions_table', 1),
(10, '2022_09_27_162541_create_brands_table', 1),
(11, '2022_09_29_143848_create_categories_table', 1),
(12, '2022_10_01_134143_create_sub_categories_table', 1),
(13, '2022_10_01_165609_create_sub_sub_categories_table', 1),
(14, '2022_10_03_155239_create_products_table', 1),
(15, '2022_10_04_143814_create_multi_images_table', 1),
(16, '2022_10_13_085807_create_sliders_table', 2),
(17, '2022_10_14_150453_create_banners_table', 3),
(18, '2022_10_26_150439_create_wishlists_table', 4),
(19, '2022_10_28_104637_create_coupons_table', 5),
(20, '2022_10_29_092257_create_states_table', 6),
(21, '2022_10_29_100823_create_districts_table', 7),
(22, '2022_10_29_142120_create_postal_codes_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

CREATE TABLE `multi_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(10, 4, 'storage/product/multi-image/product_multi_1746737136317536.webp', '2022-10-15 01:49:04', NULL),
(11, 4, 'storage/product/multi-image/product_multi_1746737136734528.webp', '2022-10-15 01:49:05', NULL),
(12, 5, 'storage/product/multi-image/product_multi_1746738069655495.webp', '2022-10-15 02:03:54', NULL),
(13, 5, 'storage/product/multi-image/product_multi_1746738070080869.webp', '2022-10-15 02:03:55', NULL),
(14, 5, 'storage/product/multi-image/product_multi_1746738070470442.webp', '2022-10-15 02:03:55', NULL),
(15, 5, 'storage/product/multi-image/product_multi_1746738070778951.webp', '2022-10-15 02:03:55', NULL),
(16, 6, 'storage/product/multi-image/product_multi_1746738288490793.webp', '2022-10-15 02:07:23', NULL),
(17, 6, 'storage/product/multi-image/product_multi_1746738288807059.webp', '2022-10-15 02:07:23', NULL),
(18, 7, 'storage/product/multi-image/product_multi_1746738504363741.webp', '2022-10-15 02:10:49', NULL),
(19, 7, 'storage/product/multi-image/product_multi_1746738504777590.webp', '2022-10-15 02:10:49', NULL),
(20, 7, 'storage/product/multi-image/product_multi_1746738505079738.webp', '2022-10-15 02:10:50', NULL),
(21, 8, 'storage/product/multi-image/product_multi_1746738742789887.webp', '2022-10-15 02:14:36', NULL),
(22, 8, 'storage/product/multi-image/product_multi_1746738743122709.webp', '2022-10-15 02:14:37', NULL),
(23, 8, 'storage/product/multi-image/product_multi_1746738743655066.webp', '2022-10-15 02:14:37', NULL),
(24, 8, 'storage/product/multi-image/product_multi_1746738744079432.webp', '2022-10-15 02:14:38', NULL),
(25, 9, 'storage/product/multi-image/product_multi_1746739147405041.webp', '2022-10-15 02:21:02', NULL),
(26, 9, 'storage/product/multi-image/product_multi_1746739147680790.webp', '2022-10-15 02:21:02', NULL),
(27, 9, 'storage/product/multi-image/product_multi_1746739148111977.webp', '2022-10-15 02:21:03', NULL),
(28, 9, 'storage/product/multi-image/product_multi_1746739148436826.webp', '2022-10-15 02:21:03', NULL),
(29, 10, 'storage/product/multi-image/product_multi_1746739486228181.webp', '2022-10-15 02:26:25', NULL),
(30, 10, 'storage/product/multi-image/product_multi_1746739486519662.webp', '2022-10-15 02:26:26', NULL),
(31, 10, 'storage/product/multi-image/product_multi_1746739486984231.webp', '2022-10-15 02:26:26', NULL),
(32, 10, 'storage/product/multi-image/product_multi_1746739487292442.webp', '2022-10-15 02:26:26', NULL),
(33, 11, 'storage/product/multi-image/product_multi_1746739701027082.webp', '2022-10-15 02:29:50', NULL),
(34, 11, 'storage/product/multi-image/product_multi_1746739701334863.webp', '2022-10-15 02:29:50', NULL),
(35, 11, 'storage/product/multi-image/product_multi_1746739701636707.webp', '2022-10-15 02:29:51', NULL),
(36, 11, 'storage/product/multi-image/product_multi_1746739702158644.webp', '2022-10-15 02:29:51', NULL),
(37, 12, 'storage/product/multi-image/product_multi_1746739925288765.webp', '2022-10-15 02:33:24', NULL),
(38, 12, 'storage/product/multi-image/product_multi_1746739925622206.webp', '2022-10-15 02:33:24', NULL),
(39, 12, 'storage/product/multi-image/product_multi_1746739925922222.webp', '2022-10-15 02:33:25', NULL),
(40, 12, 'storage/product/multi-image/product_multi_1746739926362855.webp', '2022-10-15 02:33:25', NULL),
(41, 13, 'storage/product/multi-image/product_multi_1746740427963213.webp', '2022-10-15 02:41:23', NULL),
(42, 13, 'storage/product/multi-image/product_multi_1746740428305127.webp', '2022-10-15 02:41:24', NULL),
(43, 13, 'storage/product/multi-image/product_multi_1746740428654010.webp', '2022-10-15 02:41:24', NULL),
(44, 13, 'storage/product/multi-image/product_multi_1746740429054326.webp', '2022-10-15 02:41:24', NULL),
(45, 14, 'storage/product/multi-image/product_multi_1746740875412288.webp', '2022-10-15 02:48:30', NULL),
(46, 14, 'storage/product/multi-image/product_multi_1746740875670203.webp', '2022-10-15 02:48:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"role\":{\"can-view\":\"1\"},\"permission\":{\"can-view\":\"1\"},\"user\":{\"can-view\":\"1\"}}', '2022-10-09 10:05:03', '2022-10-09 10:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postal_codes`
--

CREATE TABLE `postal_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `pincode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postal_codes`
--

INSERT INTO `postal_codes` (`id`, `state_id`, `district_id`, `pincode`, `created_at`, `updated_at`) VALUES
(4, 3, 4, 700112, '2022-10-29 09:47:32', '2022-10-29 09:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `subsubcategory_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hot_deal` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `special_offer` int(11) DEFAULT NULL,
  `special_deal` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `reviewed` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `product_name`, `product_slug`, `product_code`, `product_sku`, `product_qty`, `product_tags`, `product_size`, `product_color`, `product_thumbnail`, `base_price`, `selling_price`, `discount_price`, `short_description`, `long_description`, `hot_deal`, `featured`, `special_offer`, `special_deal`, `status`, `reviewed`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 1, 1, 'ROUND NECK CHEST STRIPED MENS TSHIRT Striped Men Round Neck Reversible Blue T-Shirt', 'round-neck-chest-striped-mens-tshirt-striped-men-round-neck-reversible-blue-t-shirt', '#56216256', 'RD-MN-TP-TS-BLU', 50, '[{\"value\":\"t-shirt\"},{\"value\":\"men\"},{\"value\":\"round\"},{\"value\":\"roadster\"},{\"value\":\"topwear\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746737135737232.webp', '1299', '279', NULL, 'This T-Shirt is made up of 60% Cotton, 40% Polyester. It is bio-washed and softener treated which makes the fabric ultra soft in touch and feel. The fabric GSM is 190.', '<p>Type</p><p>Round Neck</p><p>Sleeve</p><p>3/4 Sleeve</p><p>Fit</p><p>Regular</p><p>Fabric</p><p>Cotton Blend</p><p>Sales Package</p><p>PACK OF ONE</p><p>Pack of</p><p>1</p><p>Style Code</p><p>T229-NBLM_SR</p><p>Neck Type</p><p>Round Neck</p><p>Ideal For</p><p>Men</p><p>Size</p><p>M</p><p>Pattern</p><p>Striped</p><p>Suitable For</p><p>Western Wear</p><p>Reversible</p><p>Yes</p><p>Fabric Care</p><p>Gentle Machine Wash</p><p>This T-Shirt is made up of 60% Cotton, 40% Polyester. It is bio-washed and softener treated which makes the fabric ultra soft in touch and feel. The fabric GSM is 190.</p>', 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-15 01:49:04', '2022-10-15 02:42:48'),
(5, 12, 1, 1, 2, 'Men Regular Fit Solid Casual Shirt', 'men-regular-fit-solid-casual-shirt', '#21984099', 'WR-MN-TW-CS', 60, '[{\"value\":\"wrogn\"},{\"value\":\"casual\"},{\"value\":\"shirt\"},{\"value\":\"men\"},{\"value\":\"full\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746738069198011.webp', '2199', '899', NULL, 'Univarsal Sprtsbiz Private Limited 500 Binnamangala Road Indiranagar Bangalore 560038', '<p>Univarsal Sprtsbiz Private Limited 500 Binnamangala Road Indiranagar Bangalore 560038</p>', NULL, 1, NULL, 1, 1, 1, NULL, NULL, NULL, '2022-10-15 02:03:54', '2022-10-15 02:42:39'),
(6, 2, 2, 6, 11, 'Solid Women Polo Neck Black T-Shirt', 'solid-women-polo-neck-black-t-shirt', '#50804439', 'RD-WM-WW-TP-BLK', 20, '[{\"value\":\"women\"},{\"value\":\"top\"},{\"value\":\"black\"},{\"value\":\"roadster\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746738288095653.webp', '599', '299', NULL, 'Black pique knit polo T-shirt, has a slim polo collar, a short button placket, short sleeves, a vented hemline. The quintessential polo T-shirts from Roadster never go out of fashion. Team this tee with a pair of shorts and heels to complete a modish look.', '<p>Black pique knit polo T-shirt, has a slim polo collar, a short button placket, short sleeves, a vented hemline. The quintessential polo T-shirts from Roadster never go out of fashion. Team this tee with a pair of shorts and heels to complete a modish look.</p>', 1, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-10-15 02:07:23', '2022-10-15 02:42:56'),
(7, 4, 2, 7, 14, 'Women Blue Flats Sandal', 'women-blue-flats-sandal', '#95014514', 'AS-WM-FW-FT', 90, '[{\"value\":\"flat\"},{\"value\":\"allen slooy\"},{\"value\":\"women\"},{\"value\":\"footwear\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746738503861444.webp', '1499', '1199', NULL, 'Type\r\nFlats\r\nType for Flats\r\nSandal\r\nColor\r\nBlue', '<p>Type</p><p>Flats</p><p>Type for Flats</p><p>Sandal</p><p>Color</p><p>Blue</p>', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-10-15 02:10:48', '2022-10-15 02:43:01'),
(8, 6, 3, 10, 17, 'Lace Football Shoes For Boys & Girls  (Black)', 'lace-football-shoes-for-boys-girls-black', '#77710126', 'PU-KD-FW-SS-BLK', 30, '[{\"value\":\"football\"},{\"value\":\"shoes\"},{\"value\":\"boys\"},{\"value\":\"girls\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746738742399497.webp', '2499', '1250', NULL, 'It has Designed to be light and flexible, this edition of the Future Z lets you feel free to unleash your skills, while offering the stability you need to play your very best game.', '<p>It has Designed to be light and flexible, this edition of the Future Z lets you feel free to unleash your skills, while offering the stability you need to play your very best game.</p>', 1, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, '2022-10-15 02:14:36', '2022-10-15 02:42:34'),
(9, 5, 2, 6, 12, '511 Slim Women Blue Jeans', '511-slim-women-blue-jeans', '#78402398', 'LV-WM-WW-JN', 1, '[{\"value\":\"levi\'s\"},{\"value\":\"women\"},{\"value\":\"western wear\"},{\"value\":\"jeans\"},{\"value\":\"blue\"}]', '[{\"value\":\"M\"},{\"value\":\"L\"}]', NULL, 'storage/product/thumbnail/product_thumbnail_1746739147097158.webp', '3199', '2079', '1600', 'A modern slim with room to move; the 511 Slim Fit Jean has added stretch for all-day comfort. It offers a lean look and is a great alternative to skinny jeans.', '<p>A modern slim with room to move; the 511 Slim Fit Jean has added stretch for all-day comfort. It offers a lean look and is a great alternative to skinny jeans.</p>', NULL, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-10-15 02:21:02', '2022-10-25 05:19:59'),
(10, 9, 1, 2, 6, 'Slim Men Dark Blue Jeans', 'slim-men-dark-blue-jeans', '#77957656', 'US-MN-BW-JN', 60, '[{\"value\":\"jeans\"},{\"value\":\"uspolo\"},{\"value\":\"blue\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746739485894787.webp', '3199', '1670', NULL, 'Style Code\r\nUDJENO0114\r\nIdeal For\r\nMen\r\nSuitable For\r\nWestern Wear', '<p>Style Code</p><p>UDJENO0114</p><p>Ideal For</p><p>Men</p><p>Suitable For</p><p>Western Wear</p>', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-10-15 02:26:25', '2022-10-15 02:42:52'),
(11, 11, 1, 1, 4, 'Full Sleeve Solid Men Bomber Jacket', 'full-sleeve-solid-men-bomber-jacket', '#95698841', 'HN-MN-TW-JK', 30, '[{\"value\":\"full\"},{\"value\":\"solid\"},{\"value\":\"men\"},{\"value\":\"bomber\"},{\"value\":\"jacket\"}]', '[{\"value\":\"XS\"},{\"value\":\"S\"},{\"value\":\"M\"},{\"value\":\"L\"},{\"value\":\"XL\"}]', NULL, 'storage/product/thumbnail/product_thumbnail_1746739700632397.webp', '4199', '1789', NULL, 'Grey solid bomber with applique detail, has a mandarin collar, 3 pockets ,has a zip closure, long sleeves, straight hemline, polyester lining.', '<p>Grey solid bomber with applique detail, has a mandarin collar, 3 pockets ,has a zip closure, long sleeves, straight hemline, polyester lining.</p>', NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, '2022-10-15 02:29:50', '2022-10-21 10:36:02'),
(12, 8, 1, 21, 30, 'JOCKEY Men Top - Pyjama Set Thermal', 'jockey-men-top-pyjama-set-thermal', '#58827085', 'JK-MN-IS-TH', 5, '[{\"value\":\"jockey\"},{\"value\":\"men\"},{\"value\":\"thermal\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746739924893608.webp', '1550', '1480', NULL, 'Ideal For\r\nMen\r\nType\r\nTop - Pyjama Set\r\nFabric\r\nViscose, Cotton Blend, Polyester', '<p>Ideal For</p><p>Men</p><p>Type</p><p>Top - Pyjama Set</p><p>Fabric</p><p>Viscose, Cotton Blend, Polyester</p>', 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2022-10-15 02:33:24', '2022-10-15 02:42:29'),
(13, 3, 2, 6, 11, 'Printed Women Round Neck Maroon T-Shirt', 'printed-women-round-neck-maroon-t-shirt', '#71483354', 'HRX-WN-WW-TP', 80, '[{\"value\":\"women\"},{\"value\":\"neck\"},{\"value\":\"t-shirt\"},{\"value\":\"hrx\"}]', NULL, NULL, 'storage/product/thumbnail/product_thumbnail_1746740427643859.webp', '699', '311', NULL, 'Type\r\nRound Neck\r\nSleeve\r\nShort Sleeve\r\nFit\r\nRegular\r\nFabric\r\nPure Cotton', '<p>Type</p><p>Round Neck</p><p>Sleeve</p><p>Short Sleeve</p><p>Fit</p><p>Regular</p><p>Fabric</p><p>Pure Cotton</p>', NULL, NULL, 1, NULL, 1, 1, NULL, NULL, NULL, '2022-10-15 02:41:23', '2022-10-15 02:42:43'),
(14, 10, 3, 11, 18, 'Boys Printed Polyester T Shirt  (White, Pack of 1)', 'boys-printed-polyester-t-shirt-white-pack-of-1', '#79144069', 'LEE-KD-BC-TS-WH', 0, '[{\"value\":\"boys\"},{\"value\":\"printed\"},{\"value\":\"adidas\"}]', '[{\"value\":\"XS\"},{\"value\":\"S\"},{\"value\":\"M\"}]', NULL, 'storage/product/thumbnail/product_thumbnail_1746740874999989.webp', '3299', '1159', NULL, 'Boys Printed Polyester T Shirt  (White, Pack of 1)', '<p>Special technologynbsp;Moisture-absorbing Aeroreadynbsp;Product design detailsnbsp;White perforated football jersey t-shirtnbsp;has a V-neckshort sleevesnbsp;straight hemnbsp;applique detailWarranty: 3nbsp;monthsWarranty provided by Brand Owner/ManufacturerAbout ADIDASnbsp;Real Madrid Home Football Jersey T-shirtThis juniors home jersey reflects Real Madrids status as one of the most prestigious soccer teams on the continent.</p>', 1, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, '2022-10-15 02:48:30', '2022-10-25 04:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, '2022-10-09 10:05:03', '2022-10-09 10:05:03'),
(2, 'Admin', NULL, '2022-10-09 10:05:03', '2022-10-09 10:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hDflikZhT5LIYvll3eOnCjnHuoXaflemomyBvTH4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnRHM0Q2aEgyTkc0QmhWa2RsT2h0VUY3U2owTHJ4RGVac0lkSWl5RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9lY29tbWVyY2UuY29tL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1667057989);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_img`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 'storage/sliders/slider_1746675538261751.png', 'Don’t miss amazing<br> grocery deals', NULL, 1, '2022-10-13 11:11:15', '2022-10-14 09:31:47'),
(5, 'storage/sliders/slider_1746675577523571.png', 'Don’t miss amazing<br>grocery deals', NULL, 1, '2022-10-14 09:30:37', '2022-10-14 09:30:37'),
(6, 'storage/sliders/slider_1746675603245654.png', 'Don’t miss amazing<br>grocery', 'Shop', 1, '2022-10-14 09:31:02', '2022-10-14 09:31:02'),
(7, 'storage/sliders/slider_1746683269535579.png', 'Don’t miss amazing<br> grocery deals', 'Shop Now', 1, '2022-10-14 11:32:53', '2022-10-14 11:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Bihar', '2022-10-29 04:18:18', '2022-10-29 04:18:18'),
(3, 'West Bengal', '2022-10-29 04:18:30', '2022-10-29 04:18:30'),
(4, 'Tamil Nadu', '2022-10-29 04:18:40', '2022-10-29 04:18:40'),
(5, 'Punjab', '2022-10-29 04:18:48', '2022-10-29 04:18:48'),
(6, 'Delhi', '2022-10-29 04:19:52', '2022-10-29 04:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Topwear', 'topwear', 'Super Admin', '2022-10-09 10:07:49', '2022-10-09 10:07:49'),
(2, 1, 'Bottomwear', 'bottomwear', 'Super Admin', '2022-10-14 03:16:03', '2022-10-14 03:16:03'),
(3, 1, 'Footwear', 'footwear', 'Super Admin', '2022-10-14 03:16:17', '2022-10-14 03:16:17'),
(4, 1, 'Indian & Festive wear', 'indian-festive-wear', 'Super Admin', '2022-10-14 03:16:40', '2022-10-14 03:16:40'),
(5, 2, 'Indian & Fusion wear', 'indian-fusion-wear', 'Super Admin', '2022-10-14 03:17:29', '2022-10-14 03:17:29'),
(6, 2, 'Western wear', 'western-wear', 'Super Admin', '2022-10-14 03:17:51', '2022-10-14 03:17:51'),
(7, 2, 'Footwear', 'footwear', 'Super Admin', '2022-10-14 03:18:01', '2022-10-14 03:18:01'),
(8, 2, 'Jewellery', 'jewellery', 'Super Admin', '2022-10-14 03:18:23', '2022-10-14 03:18:23'),
(9, 3, 'Toys', 'toys', 'Super Admin', '2022-10-14 03:18:54', '2022-10-14 03:18:54'),
(10, 3, 'Footwear', 'footwear', 'Super Admin', '2022-10-14 03:19:03', '2022-10-14 03:19:03'),
(11, 3, 'Boy\'s Clothing', 'boys-clothing', 'Super Admin', '2022-10-14 03:19:23', '2022-10-14 03:19:23'),
(12, 3, 'Girl\'s Clothing', 'girls-clothing', 'Super Admin', '2022-10-14 03:19:48', '2022-10-14 03:19:48'),
(13, 4, 'Bath', 'bath', 'Super Admin', '2022-10-14 03:21:05', '2022-10-14 03:21:05'),
(14, 4, 'Flooring', 'flooring', 'Super Admin', '2022-10-14 03:21:18', '2022-10-14 03:21:18'),
(15, 4, 'Lamp & Lighting', 'lamp-lighting', 'Super Admin', '2022-10-14 03:21:32', '2022-10-14 03:21:32'),
(16, 4, 'Bed Linen & Furnishing', 'bed-linen-furnishing', 'Super Admin', '2022-10-14 03:21:49', '2022-10-14 03:21:49'),
(17, 5, 'Makeup', 'makeup', 'Super Admin', '2022-10-14 03:22:23', '2022-10-14 03:22:23'),
(18, 5, 'Haircare', 'haircare', 'Super Admin', '2022-10-14 03:22:32', '2022-10-14 03:22:32'),
(19, 5, 'Fragrances', 'fragrances', 'Super Admin', '2022-10-14 03:22:57', '2022-10-14 03:22:57'),
(20, 1, 'Gadgets', 'gadgets', 'Super Admin', '2022-10-14 03:39:41', '2022-10-14 03:39:41'),
(21, 1, 'Innerwear & Sleepwear', 'innerwear-sleepwear', 'Super Admin', '2022-10-14 03:40:04', '2022-10-14 03:40:04'),
(22, 1, 'Watches', 'watches', 'Super Admin', '2022-10-14 03:40:14', '2022-10-14 03:40:14'),
(23, 1, 'Fashion Accessories', 'fashion-accessories', 'Super Admin', '2022-10-14 03:40:30', '2022-10-14 03:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_sub_categories`
--

INSERT INTO `sub_sub_categories` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'T-shirt', 't-shirt', 'Super Admin', '2022-10-09 10:08:04', '2022-10-09 10:08:04'),
(2, 1, 1, 'Casual Shirts', 'casual-shirts', 'Super Admin', '2022-10-14 03:24:26', '2022-10-14 03:24:26'),
(4, 1, 1, 'Jackets', 'jackets', 'Super Admin', '2022-10-14 03:24:37', '2022-10-14 03:24:37'),
(5, 1, 2, 'Shorts', 'shorts', 'Super Admin', '2022-10-14 03:24:48', '2022-10-14 03:24:48'),
(6, 1, 2, 'Jeans', 'jeans', 'Super Admin', '2022-10-14 03:25:02', '2022-10-14 03:25:02'),
(7, 1, 3, 'Sneakers', 'sneakers', 'Super Admin', '2022-10-14 03:26:40', '2022-10-14 03:26:40'),
(8, 1, 3, 'Casual Shoes', 'casual-shoes', 'Super Admin', '2022-10-14 03:26:59', '2022-10-14 03:26:59'),
(9, 2, 5, 'Kurtas & Suits', 'kurtas-suits', 'Super Admin', '2022-10-14 03:27:24', '2022-10-14 03:27:24'),
(10, 2, 5, 'Sarees', 'sarees', 'Super Admin', '2022-10-14 03:27:34', '2022-10-14 03:27:34'),
(11, 2, 6, 'Tops', 'tops', 'Super Admin', '2022-10-14 03:27:48', '2022-10-14 03:27:48'),
(12, 2, 6, 'Jeans', 'jeans', 'Super Admin', '2022-10-14 03:28:01', '2022-10-14 03:28:01'),
(13, 2, 8, 'Earrings', 'earrings', 'Super Admin', '2022-10-14 03:28:30', '2022-10-14 03:28:30'),
(14, 2, 7, 'Flats', 'flats', 'Super Admin', '2022-10-14 03:28:43', '2022-10-14 03:28:43'),
(15, 2, 7, 'Heels', 'heels', 'Super Admin', '2022-10-14 03:28:57', '2022-10-14 03:28:57'),
(16, 3, 9, 'Soft Toys', 'soft-toys', 'Super Admin', '2022-10-14 03:29:30', '2022-10-14 03:29:30'),
(17, 3, 10, 'School Shoes', 'school-shoes', 'Super Admin', '2022-10-14 03:29:55', '2022-10-14 03:29:55'),
(18, 3, 11, 'T-shirts', 't-shirts', 'Super Admin', '2022-10-14 03:30:10', '2022-10-14 03:30:10'),
(19, 3, 11, 'Shorts', 'shorts', 'Super Admin', '2022-10-14 03:30:21', '2022-10-14 03:30:21'),
(20, 3, 12, 'Tops', 'tops', 'Super Admin', '2022-10-14 03:30:34', '2022-10-14 03:30:34'),
(21, 3, 12, 'Lehenga Choli', 'lehenga-choli', 'Super Admin', '2022-10-14 03:30:52', '2022-10-14 03:30:52'),
(22, 4, 13, 'Bath Towels', 'bath-towels', 'Super Admin', '2022-10-14 03:31:13', '2022-10-14 03:31:13'),
(23, 4, 13, 'Bath Rugs', 'bath-rugs', 'Super Admin', '2022-10-14 03:31:28', '2022-10-14 03:31:28'),
(24, 4, 14, 'Carpets', 'carpets', 'Super Admin', '2022-10-14 03:31:41', '2022-10-14 03:31:41'),
(25, 1, 4, 'Kurta & Kurta Sets', 'kurta-kurta-sets', 'Super Admin', '2022-10-14 03:42:23', '2022-10-14 03:42:23'),
(26, 1, 4, 'Sherwanis', 'sherwanis', 'Super Admin', '2022-10-14 03:42:49', '2022-10-14 03:42:49'),
(27, 1, 4, 'Dhotis', 'dhotis', 'Super Admin', '2022-10-14 03:43:02', '2022-10-14 03:43:02'),
(28, 1, 21, 'Boxer', 'boxer', 'Super Admin', '2022-10-14 03:43:31', '2022-10-14 03:43:31'),
(29, 1, 21, 'Vets', 'vets', 'Super Admin', '2022-10-14 03:43:48', '2022-10-14 03:43:48'),
(30, 1, 21, 'Thermals', 'thermals', 'Super Admin', '2022-10-14 03:45:01', '2022-10-14 03:45:01'),
(31, 1, 20, 'Headphones', 'headphones', 'Super Admin', '2022-10-14 03:46:11', '2022-10-14 03:46:11'),
(32, 1, 20, 'Speakers', 'speakers', 'Super Admin', '2022-10-14 03:46:29', '2022-10-14 03:46:29'),
(33, 1, 23, 'Wallets', 'wallets', 'Super Admin', '2022-10-14 03:47:21', '2022-10-14 03:47:21'),
(34, 1, 23, 'Belts', 'belts', 'Super Admin', '2022-10-14 03:47:32', '2022-10-14 03:47:32'),
(35, 1, 23, 'Trimmers', 'trimmers', 'Super Admin', '2022-10-14 03:47:52', '2022-10-14 03:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(11) NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Roshan Kumar Panjiyara', 'roshanpanjiyara@gmail.com', NULL, '$2y$10$qbi3qLxfMAh/ZSD7ewgI5.Zcc5lvlxYCxYZZSOjCsG2kSsVSyXHU6', 2147483647, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-10 00:55:48', '2022-10-11 09:42:19'),
(2, 'Evan Kumar', 'roshan@gmail.com', NULL, '$2y$10$xUIJm/V7rVctNTihlhjaaO.gKyJb8k7JzX8Q7DyqTbSFILw1fCBPW', 9999999999, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-13 11:24:44', '2022-10-13 11:24:44'),
(3, 'Raj', 'raj@gmail.com', NULL, '$2y$10$iNgs5e2lT9KAmUb9miX.hu8KMUW0l/Ct6Y2nxCfmnnD7ecitXpULe', 9831994526, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-14 01:25:54', '2022-10-14 01:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 1, 14, '2022-10-27 03:35:04', '2022-10-27 03:35:04'),
(6, 1, 8, '2022-10-27 04:41:51', '2022-10-27 04:41:51'),
(7, 1, 13, '2022-10-27 04:43:50', '2022-10-27 04:43:50'),
(9, 1, 11, '2022-10-27 04:51:23', '2022-10-27 04:51:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_state_id_foreign` (`state_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_images`
--
ALTER TABLE `multi_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multi_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `postal_codes`
--
ALTER TABLE `postal_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postal_codes_state_id_foreign` (`state_id`),
  ADD KEY `postal_codes_district_id_foreign` (`district_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_subsubcategory_id_foreign` (`subsubcategory_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_sub_categories_category_id_foreign` (`category_id`),
  ADD KEY `sub_sub_categories_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `multi_images`
--
ALTER TABLE `multi_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postal_codes`
--
ALTER TABLE `postal_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `multi_images`
--
ALTER TABLE `multi_images`
  ADD CONSTRAINT `multi_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postal_codes`
--
ALTER TABLE `postal_codes`
  ADD CONSTRAINT `postal_codes_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `postal_codes_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subsubcategory_id_foreign` FOREIGN KEY (`subsubcategory_id`) REFERENCES `sub_sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD CONSTRAINT `sub_sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_sub_categories_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
