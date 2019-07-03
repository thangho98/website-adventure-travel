-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 03, 2019 lúc 06:12 AM
-- Phiên bản máy phục vụ: 10.3.15-MariaDB
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dlmh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_tours`
--

CREATE TABLE `booking_tours` (
  `bt_id` int(10) UNSIGNED NOT NULL,
  `bt_num_child` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bt_num_adult` date NOT NULL,
  `bt_total_price` int(11) NOT NULL,
  `bt_date` datetime NOT NULL,
  `bt_pay_status` int(11) NOT NULL,
  `bt_booking_status` int(11) NOT NULL,
  `bt_user_client` int(11) NOT NULL,
  `bt_tour` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(10) UNSIGNED NOT NULL,
  `cate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cate_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `cate_image`, `created_at`, `updated_at`) VALUES
(2, 'Nhảy dù', '1561535871.jpeg', '2019-06-26 07:57:52', '2019-06-26 07:57:52'),
(3, 'Lặn biển', '1561535892.jpeg', '2019-06-26 07:58:12', '2019-06-26 07:58:12'),
(4, 'Leo núi', '1561537121.jpeg', '2019-06-26 08:18:41', '2019-06-26 08:18:41'),
(5, 'Khám phá hang động', '1561537148.jpeg', '2019-06-26 08:19:08', '2019-06-26 08:19:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `destinations`
--

CREATE TABLE `destinations` (
  `dest_id` int(10) UNSIGNED NOT NULL,
  `dest_tourist_route` int(11) NOT NULL,
  `dest_location` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `destinations`
--

INSERT INTO `destinations` (`dest_id`, `dest_tourist_route`, `dest_location`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, 2, 5, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(3, 2, 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(4, 2, 6, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(5, 2, 1, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(6, 3, 6, '2019-06-29 04:25:15', '2019-06-29 04:25:15'),
(7, 3, 2, '2019-06-29 04:25:15', '2019-06-29 04:25:15'),
(20, 4, 6, '2019-06-29 11:12:27', '2019-06-29 11:12:27'),
(21, 4, 2, '2019-06-29 11:12:27', '2019-06-29 11:12:27'),
(22, 4, 4, '2019-06-29 11:12:27', '2019-06-29 11:12:27'),
(23, 4, 1, '2019-06-29 11:12:28', '2019-06-29 11:12:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite_tours`
--

CREATE TABLE `favorite_tours` (
  `fa_id` int(10) UNSIGNED NOT NULL,
  `fa_user_client` int(11) NOT NULL,
  `fa_tour` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_news`
--

CREATE TABLE `image_news` (
  `in_id` int(10) UNSIGNED NOT NULL,
  `in_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `in_news` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_tourist_routes`
--

CREATE TABLE `image_tourist_routes` (
  `itr_id` int(10) UNSIGNED NOT NULL,
  `itr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `itr_tourist_route` int(11) NOT NULL,
  `itr_highlight` tinyint(1) NOT NULL,
  `itr_default` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image_tourist_routes`
--

INSERT INTO `image_tourist_routes` (`itr_id`, `itr_name`, `itr_tourist_route`, `itr_highlight`, `itr_default`, `created_at`, `updated_at`) VALUES
(1, '156172601915617260194155.jpeg', 1, 1, 1, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, '156172601915617260195336.jpeg', 1, 0, 0, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(3, '156172601915617260196150.jpeg', 1, 0, 0, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(4, '156178231615617823161738.jpeg', 3, 1, 1, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(5, '156178231615617823163112.jpeg', 3, 0, 0, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(6, '156178231615617823164663.jpeg', 3, 0, 0, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(7, '1561806748.jpeg', 4, 1, 1, '2019-06-29 04:25:51', '2019-06-29 11:12:28'),
(9, '156178235115617823515773.jpeg', 4, 0, 0, '2019-06-29 04:25:51', '2019-06-29 04:25:51'),
(11, '156180674815618067485108.jpeg', 4, 0, 0, '2019-06-29 11:12:28', '2019-06-29 11:12:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locations`
--

CREATE TABLE `locations` (
  `loca_id` int(10) UNSIGNED NOT NULL,
  `loca_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loca_description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `loca_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `locations`
--

INSERT INTO `locations` (`loca_id`, `loca_name`, `loca_description`, `loca_poster`, `created_at`, `updated_at`) VALUES
(1, 'Lào Cai', 'Việt Nam', '1561546084.jpeg', '2019-06-26 10:48:04', '2019-06-26 10:48:04'),
(2, 'Điện Biên Phủ', 'Việt Nam', '1561546123.jpeg', '2019-06-26 10:48:43', '2019-06-26 10:48:43'),
(4, 'Lai Châu', 'Việt Nam', '1561546429.jpeg', '2019-06-26 10:49:48', '2019-06-26 10:53:49'),
(5, 'Gia Lai', 'Việt Nam', '1561546453.jpeg', '2019-06-26 10:54:13', '2019-06-26 10:54:13'),
(6, 'Cần Thơ', 'Việt Nam', '1561546476.jpeg', '2019-06-26 10:54:36', '2019-06-26 10:54:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_06_24_193644_create_tours_table', 2),
(9, '2019_06_24_193748_create_destinations_table', 2),
(10, '2019_06_24_193838_create_locations_table', 2),
(11, '2019_06_24_194036_create_tourist_route_details_table', 2),
(12, '2019_06_24_194436_create_categories_table', 2),
(13, '2019_06_24_194636_create_tourist_routes_table', 2),
(14, '2019_06_24_194750_create_reviews_table', 2),
(15, '2019_06_24_200852_create_booking_tours_table', 2),
(16, '2019_06_24_201743_create_favorite_tours_table', 2),
(17, '2019_06_24_201900_create_image_tourist_routes_table', 2),
(18, '2019_06_24_202012_create_news_table', 2),
(19, '2019_06_24_202101_create_user_clients_table', 2),
(20, '2019_06_24_214743_create_image_news_table', 2),
(21, '2019_06_24_222828_create_promotions_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(10) UNSIGNED NOT NULL,
  `news_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `news_time_post` date NOT NULL,
  `news_user_admin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_description`, `news_poster`, `news_content`, `news_time_post`, `news_user_admin`, `created_at`, `updated_at`) VALUES
(1, 'The three greatest things you learn from traveling 1998', 'Like all the great things on earth traveling teaches us by example. Here are some of the most precious lessons I’ve learned over the years of traveling 1998.', '1562125881.jpeg', '<h2>The three greatest things you learn from traveling</h2><p>Like all the great things on earth traveling teaches us by example. Here are some of the most precious lessons I’ve learned over the years of traveling.</p><figure class=\"media\"><oembed url=\"https://www.youtube.com/watch?v=BLJ4GKKaiXw\"></oembed></figure><h3>Appreciation of diversity</h3><p>Getting used to an entirely different culture can be challenging. While it’s also nice to learn about cultures online or from books, nothing comes close to experiencing cultural diversity in person. You learn to appreciate each and every single one of the differences while you become more culturally fluid.</p><blockquote><p>The real voyage of discovery consists not in seeking new landscapes, but having new eyes.</p><p><strong>Marcel Proust</strong></p></blockquote><h3>Improvisation</h3><p>Life doesn\'t allow us to execute every single plan perfectly. This especially seems to be the case when you travel. You plan it down to every minute with a big checklist; but when it comes to executing it, something always comes up and you’re left with your improvising skills. You learn to adapt as you go. Here’s how my travel checklist looks now:</p><ul><li>buy the ticket</li><li>start your adventure</li></ul><h3>Confidence</h3><p>Going to a new place can be quite terrifying. While change and uncertainty makes us scared, traveling teaches us how ridiculous it is to be afraid of something before it happens. The moment you face your fear and see there was nothing to be afraid of, is the moment you discover bliss.</p>', '2019-07-03', 1, '2019-07-03 02:59:51', '2019-07-03 03:51:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `prom_id` int(10) UNSIGNED NOT NULL,
  `prom_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prom_description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `prom_percent_promotion` int(11) NOT NULL,
  `prom_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`prom_id`, `prom_name`, `prom_description`, `prom_percent_promotion`, `prom_banner`, `created_at`, `updated_at`) VALUES
(1, 'Chào mừng hè', 'Hè tới rồi đi du lịch thôi bạn ơi', 15, '1561819077.jpeg', '2019-06-29 14:37:57', '2019-06-29 14:37:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `revi_id` int(10) UNSIGNED NOT NULL,
  `revi_star` int(11) NOT NULL,
  `revi_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revi_time` datetime NOT NULL,
  `revi_tourist_route` int(11) NOT NULL,
  `revi_user_client` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`revi_id`, `revi_star`, `revi_content`, `revi_time`, `revi_tourist_route`, `revi_user_client`, `created_at`, `updated_at`) VALUES
(1, 4, 'Tour này thật tuyệt vời :))', '2019-06-29 08:21:23', 1, 1, '2019-06-28 17:00:00', '2019-06-28 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tourist_routes`
--

CREATE TABLE `tourist_routes` (
  `tr_id` int(10) UNSIGNED NOT NULL,
  `tr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_category` int(11) NOT NULL,
  `tr_introduction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_time` int(11) NOT NULL,
  `tr_original_price` double NOT NULL,
  `tr_max_slot` int(11) NOT NULL,
  `tr_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_location` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tourist_routes`
--

INSERT INTO `tourist_routes` (`tr_id`, `tr_name`, `tr_category`, `tr_introduction`, `tr_time`, `tr_original_price`, `tr_max_slot`, `tr_poster`, `tr_location`, `created_at`, `updated_at`) VALUES
(1, 'Chèo đèo', 2, 'haha', 2, 300000, 2, '1561726019.jpeg', 2, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, 'lala', 2, '', 2, 100000, 2, '1561738745.jpeg', 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(3, 'Vượt thác', 3, '', 3, 1000000, 10, '1561782315.jpeg', 1, '2019-06-29 04:25:15', '2019-06-29 04:25:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tourist_route_details`
--

CREATE TABLE `tourist_route_details` (
  `trd_id` int(10) UNSIGNED NOT NULL,
  `trd_date` int(11) NOT NULL,
  `trd_description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `trd_tourist_route` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tourist_route_details`
--

INSERT INTO `tourist_route_details` (`trd_id`, `trd_date`, `trd_description`, `trd_tourist_route`, `created_at`, `updated_at`) VALUES
(1, 1, 'Leo núi mệt quá', 1, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, 2, 'Chán đời thôi', 1, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(3, 1, 'lễ', 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(4, 2, 'lộc', 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(5, 1, 'Vui chơi cả ngày', 3, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(6, 2, 'Đập tan mùa hè', 3, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(7, 3, 'Chán đời', 3, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(15, 1, 'Vui chơi cả ngày', 4, '2019-06-29 11:12:28', '2019-06-29 11:12:28'),
(16, 2, 'Đập tan mùa hè', 4, '2019-06-29 11:12:28', '2019-06-29 11:12:28'),
(17, 3, 'Chán đời', 4, '2019-06-29 11:12:28', '2019-06-29 11:12:28'),
(18, 4, 'Hế lô :))', 4, '2019-06-29 11:12:28', '2019-06-29 11:12:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `tour_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tour_time_start` date NOT NULL,
  `tour_slot_book` int(11) DEFAULT 0,
  `tour_price` double NOT NULL,
  `tour_tourist_route` int(11) NOT NULL,
  `tour_promotion` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_code`, `tour_time_start`, `tour_slot_book`, `tour_price`, `tour_tourist_route`, `tour_promotion`, `created_at`, `updated_at`) VALUES
(1, '120190822', '2019-08-22', 0, 300000, 1, 0, '2019-07-01 04:16:33', '2019-07-01 04:16:33'),
(2, '120190925', '2019-09-25', 0, 255000, 1, 1, '2019-07-01 04:16:33', '2019-07-01 06:51:53'),
(3, '120191211', '2019-12-11', 0, 300000, 1, 0, '2019-07-01 04:16:33', '2019-07-01 04:16:33'),
(4, '120200108', '2020-01-08', 0, 300000, 1, 0, '2019-07-01 04:16:33', '2019-07-01 04:16:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `bio` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile.png',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `bio`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@me.com', NULL, '$2y$10$4A2amIGywuzvJTG5GVO/Ke48QYIUzk94CeztmzHXy7aYfMV0RzvGy', 'admin', NULL, 'profile.png', 'bpHXEqHtW4E9Dl0bWK388Ulqisv2Zl4clZnrnyNb8CA5x1c4jtwm7MJdsxE5', '2019-06-23 12:13:05', '2019-06-25 18:01:18'),
(2, 'thang thai', 'thanglong2098@gmail.com', NULL, '$2y$10$4A2amIGywuzvJTG5GVO/Ke48QYIUzk94CeztmzHXy7aYfMV0RzvGy', 'admin', NULL, 'profile.png', NULL, '2019-06-25 10:05:18', '2019-06-25 10:05:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_clients`
--

CREATE TABLE `user_clients` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_gender` tinyint(1) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_clients`
--

INSERT INTO `user_clients` (`user_id`, `user_name`, `user_email`, `password`, `user_phone`, `user_gender`, `user_birthday`, `user_address`, `created_at`, `updated_at`) VALUES
(1, 'Hồ Thái Thăng', 'thanglong2098@gmail.com', '', '0147258369', 1, '1998-04-25', 'Ho Chi Minh City', '2019-06-28 17:00:00', '2019-06-28 17:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `booking_tours`
--
ALTER TABLE `booking_tours`
  ADD PRIMARY KEY (`bt_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`dest_id`);

--
-- Chỉ mục cho bảng `favorite_tours`
--
ALTER TABLE `favorite_tours`
  ADD PRIMARY KEY (`fa_id`);

--
-- Chỉ mục cho bảng `image_news`
--
ALTER TABLE `image_news`
  ADD PRIMARY KEY (`in_id`);

--
-- Chỉ mục cho bảng `image_tourist_routes`
--
ALTER TABLE `image_tourist_routes`
  ADD PRIMARY KEY (`itr_id`);

--
-- Chỉ mục cho bảng `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`loca_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Chỉ mục cho bảng `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`prom_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`revi_id`);

--
-- Chỉ mục cho bảng `tourist_routes`
--
ALTER TABLE `tourist_routes`
  ADD PRIMARY KEY (`tr_id`);

--
-- Chỉ mục cho bảng `tourist_route_details`
--
ALTER TABLE `tourist_route_details`
  ADD PRIMARY KEY (`trd_id`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD UNIQUE KEY `tour_code` (`tour_code`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_clients`
--
ALTER TABLE `user_clients`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_clients_user_email_unique` (`user_email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `booking_tours`
--
ALTER TABLE `booking_tours`
  MODIFY `bt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `destinations`
--
ALTER TABLE `destinations`
  MODIFY `dest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `favorite_tours`
--
ALTER TABLE `favorite_tours`
  MODIFY `fa_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `image_news`
--
ALTER TABLE `image_news`
  MODIFY `in_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `image_tourist_routes`
--
ALTER TABLE `image_tourist_routes`
  MODIFY `itr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `locations`
--
ALTER TABLE `locations`
  MODIFY `loca_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `prom_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `revi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tourist_routes`
--
ALTER TABLE `tourist_routes`
  MODIFY `tr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tourist_route_details`
--
ALTER TABLE `tourist_route_details`
  MODIFY `trd_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user_clients`
--
ALTER TABLE `user_clients`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
